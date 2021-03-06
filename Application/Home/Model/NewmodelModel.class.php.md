# 模型实例化
在ThinkPHP中，可以无需进行任何模型定义。只有在需要封装单独的业务逻辑的时候，模型类才是必须被定义的，因此ThinkPHP在模型上有很多的灵活和方便性，让你无需因为表太多而烦恼。
根据不同的模型定义，我们有几种实例化模型的方法，根据需要采用不同的方式：
## 直接实例化
可以和实例化其他类库一样实例化模型类，例如：
<pre><code>$User = new \Home\Model\UserModel();
$Info = new \Admin\Model\InfoModel();
// 带参数实例化
$New = new \Home\Model\NewModel('blog','think_',$connection);</code></pre>  
模型类通常都是继承系统的\Think\Model类，该类的架构方法有三个参数，分别是：
<pre><code>Model(['模型名'],['数据表前缀'],['数据库连接信息']);</code></pre>
三个参数都是可选的，大多数情况下，我们根本无需传入任何参数即可实例化。

<table>
	<tr>
		<th>参数</th>
		<th>描述</th>
	</tr>
	<tr>
		<td>模型名模型的名称</td>
		<td>和数据表前缀一起配合用于自动识别数据表名称</td>
	</tr>
	<tr>
		<td>数据表前缀当前数据表前缀</td>
		<td>和模型名一起配合用于自动识别数据表名称</td>
	</tr>
	<tr>
       	<th>数据库连接信息当前数据表的数据库连接信息</th>
       	<th>如果没有则获取配置文件中的</th>
        </tr>
</table>

###### 数据表前缀传入空字符串表示取当前配置的表前缀，如果当前数据表没有前缀，则传入null即可。
数据库连接信息参数支持三种格式：
#### 1、字符串定义
字符串定义采用DSN格式定义，格式定义规范为：
数据库类型://用户名:密码@数据库主机名或者IP:数据库端口/数据库名#字符集
例如：
<pre><code>new \Home\Model\NewModel('blog','think_','mysql://root:1234@localhost/demo');</pre></code>
#### 2、数组定义
可以传入数组格式的数据库连接信息，例如：
<pre><code>$connection = array(
'db_type' => 'mysql',
'db_host' => '127.0.0.1',
'db_user' => 'root',
'db_pwd' => '12345',
'db_port' => 3306,
'db_name' => 'demo',
'db_charset' => 'utf8',
);
new \Home\Model\NewModel('new','think_',$connection);</pre></code>
如果需要的话，还可以传入更多的连接参数，包括数据的部署模式和调试模式设定，例如：
<pre><code>$connection = array(
'db_type' => 'mysql',
'db_host' => '192.168.1.2,192.168.1.3',
'db_user' => 'root',
'db_pwd' => '12345',
'db_port' => 3306,
'db_name' => 'demo',
'db_charset' => 'utf8',
'db_deploy_type'=> 1,
'db_rw_separate'=> true,
'db_debug' => true,
);
// 分布式数据库部署 并且采用读写分离 开启数据库调试模式
new \Home\Model\NewModel('new','think_',$connection);</pre></code>
###### 注意，如果设置了db_debug参数，那么数据库调试模式就不再受APP_DEBUG常量影响。
#### 3、配置定义
我们可以事先在配置文件中定义好数据库连接信息，然后在实例化的时候直接传入配置的名称即可，例如：
<pre><code>//数据库配置1
'DB_CONFIG1' => array(
'db_type' => 'mysql',
'db_user' => 'root',
'db_pwd' => '1234',
'db_host' => 'localhost',
'db_port' => '3306',
'db_name' => 'thinkphp'
),
//数据库配置2
'DB_CONFIG2' => 'mysql://root:1234@localhost:3306/thinkphp',</code></pre>
在配置文件中定义数据库连接信息的时候也支持字符串和数组格式，格式和上面实例化传入的参数一样。
然后，我们就可以这样实例化模型类传入连接信息：
<pre><code>new \Home\Model\NewModel('new','think_','DB_CONFIG1');
new \Home\Model\BlogModel('blog','think_','DB_CONFIG2');</code></pre>
事实上，当我们实例化的时候没有传入任何的数据库连接信息的时候，系统其实默认会获取配置文件中的相关配置参数，包括：
<pre><code>'DB_TYPE' => '', // 数据库类型
'DB_HOST' => '', // 服务器地址
'DB_NAME' => '', // 数据库名
'DB_USER' => '', // 用户名
'DB_PWD' => '', // 密码
'DB_PORT' => '', // 端口
'DB_PREFIX' => '', // 数据库表前缀
'DB_DSN' => '', // 数据库连接DSN 用于PDO方式
'DB_CHARSET' => 'utf8', // 数据库的编码 默认为utf8</code></pre>
如果应用配置文件中有配置上述数据库连接信息的话，实例化模型将会变得非常简单。
D方法实例化
上面实例化的时候我们需要传入完整的类名，系统提供了一个快捷方法D用于数据模型的实例化操作。
要实例化自定义模型类，可以使用下面的方式：
<pre><code>//实例化模型
$User = D('User');
// 相当于 $User = new \Home\Model\UserModel();
// 执行具体的数据操作
$User->select();</code></pre>
当 \Home\Model\UserModel 类不存在的时候，D函数会尝试实例化公共模块下面的\Common\Model\UserModel 类。
D方法的参数就是模型的名称，并且和模型类的大小写定义是一致的，例如：
参数实例化的模型文件（假设当前模块为Home）
User 对应的模型类文件的 \Home\Model\UserModel.class.php
UserType 对应的模型类文件的 \Home\Model\UserTypeModel.class.php
###### 如果在Linux环境下面，一定要注意D方法实例化的时候的模型名称的大小写。
D方法可以自动检测模型类，如果存在自定义的模型类，则实例化自定义模型类，如果不存在，则会实例化系统的\Think\Model基类，同时对于已实例化过的模型，不会重复实例化。
D方法还可以支持跨模块调用，需要使用：
<pre><code>//实例化Admin模块的User模型
D('Admin/User');
//实例化Extend扩展命名空间下的Info模型
D('Extend://Editor/Info');</code></pre>
注意：跨模块实例化模型类的时候 不支持自动加载公共模块的模型类。
## M方法实例化模型
D方法实例化模型类的时候通常是实例化某个具体的模型类，如果你仅仅是对数据表进行基本的CURD操作的话，使用M方法实例化的话，由于不需要加载具体的模型类，所以性能会更高。
例如：
<pre><code>// 使用M方法实例化
$User = M('User');
// 和用法 $User = new \Think\Model('User'); 等效
// 执行其他的数据操作
$User->select();</code></pre>
M方法也可以支持跨库操作，例如：
<pre><code>// 使用M方法实例化 操作db_name数据库的ot_user表
$User = M('db_name.User','ot_');
// 执行其他的数据操作
$User->select();</code></pre>
M方法的参数和\Think\Model类的参数是一样的，也就是说，我们也可以这样实例化：
<pre><code>$New = M('new','think_',$connection);
// 等效于 $New = new \Think\Model('new','think_',$connection);</code></pre>
具体的参数含义可以参考前面的介绍。
M方法实例化的时候，默认情况下是直接实例化系统的\Think\Model类，如果我们希望实例化其他的公共模型类的话，可以使用如下方法：
<pre><code>$User = M('\Home\Model\CommonModel:User','think_','db_config');
// 相当于 $User = new \Home\Model\CommonModel('User','think_','db_config');</code></pre>
###### 如果你的模型类有自己的业务逻辑，M方法是无法支持的，就算是你已经定义了具体的模型类，M方法实例化的时候是会直接忽略。
## 实例化空模型类
如果你仅仅是使用原生SQL查询的话，不需要使用额外的模型类，实例化一个空模型类即可进行操作了，
例如：
<pre><code>//实例化空模型
$Model = new Model();
//或者使用M快捷方法是等效的
$Model = M();
//进行原生的SQL查询
$Model->query('SELECT * FROM think_user WHERE status = 1');</code></pre>
###### 实例化空模型类后还可以用table方法切换到具体的数据表进行操作
我们在实例化的过程中，经常使用D方法和M方法，这两个方法的区别在于M方法实例化模型无需用户为
每个数据表定义模型类，如果D方法没有找到定义的模型类，则会自动调用M方法。