<!--
<?php
<pre><code>namespace Home\Model;
use Think\Model;
-->
/*
# 模型
在thinkphp中基础的模型类就是think\model 类，该类完成了基本的curd、activerecord模式、连贯操作和统计查询，一些高级特性被封装到另外的模型扩展中。
基础模型类的设计非常灵活，甚至可以无需进行任何模型定义，就可以进行相关数据表的orm和curd操作，只有在需要封装单独的业务逻辑的时候，模型类才是必须被定义的。
# 模型定义
模型类并非必须定义，只有当存在独立的业务逻辑或者属性的时候才需要定义。
模型类通常需要继承系统的\Think\Model类或其子类，下面是一个Home\Model\UserModel类的定义：

<pre><code>namespace Home\Model;
use Think\Model;
class UserModel extends Model {
}</code></pre>
模型类的作用大多数情况是操作数据表的，如果按照系统的规范来命名模型类的话，大多数情况下是可以自动对应数据表。
模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写，然后加上模型层的名称（默认定义是Model），例如：
<table>
<tr>
<th>模型名约定对应数据表</th><th>（假设数据库的前缀定义是 think_）</th>
</tr>
<tr>
<td>UserModel</td><td>think_user</td>
</tr>
<tr>
<td>UserTypeModel</td><td>think_user_type</td>
</tr>
</table>如果你的规则和上面的系统约定不符合，那么需要设置Model类的数据表名称属性，以确保能够找到对应的数据表。

# 数据表定义
在ThinkPHP的模型里面，有几个关于数据表名称的属性定义：
<table>
<tr>
	<th>属性</th>
	<th>说明</th>
</tr>
<tr>
	<td>tablePrefix</td>
	<td>定义模型对应数据表的前缀，如果未定义则获取配置文件中的DB_PREFIX参数</td>
</tr>
<tr>
	<td>tableName</td>
	<td>不包含表前缀的数据表名称，一般情况下默认和模型名称相同，只有当你的表名和当前的模型类的名称不同的时候才需要定义。</td>
</tr>
<tr>
	<td>trueTableName</td>
	<td>包含前缀的数据表名称，也就是数据库中的实际表名，该名称无需设置，只有当上面的规则都不适用的情况或者特殊情况下才需要设置。</td>
</tr>
<tr>
	<td>dbName</td>
	<td>定义模型当前对应的数据库名称，只有当你当前的模型类对应的数据库名称和配置文件不同的时候才需要定义。</td>
</tr>
 </table>
 
 
 举个例子来加深理解，例如，在数据库里面有一个think_categories 表，而我们定义的模型类名称是CategoryModel ，按照系统的约定，这个模型的名称是Category，对应的数据表名称应该是think_category （全部小写），但是现在的数据表名称是think_categories ，因此我们就需要tableName 属性来改变默认的规则（假设我们已经在配置文件里面定义了DB_PREFIX 为 think_）。

<pre><code>namespace Home\Model;
use Think\Model;
class CategoryModel extends Model {
protected $tableName = 'categories';
}</code></pre>
注意这个属性的定义不需要加表的前缀think_

如果我们需要CategoryModel模型对应操作的数据表是 top_category ，那么我们只需要设置数据表前缀即可：
<pre><code>namespace Home\Model;
use Think\Model;
class CategoryModel extends Model {
protected $tablePrefix = 'top_';
}</code></pre>
如果你的数据表直接就是category ，而没有前缀，则可以设置tablePrefix 为空字符串。
<pre><code>namespace Home\Model;
use Think\Model;
class CategoryModel extends Model {
protected $tablePrefix = '';
}</code></pre>
没有表前缀的情况必须设置，否则会获取当前配置文件中的 DB_PREFIX 。
而对于另外一种特殊情况，我们需要操作的数据表是top_categories ，这个时候我们就需要定义trueTableName 属性
<pre><code>namespace Home\Model;
use Think\Model;
class CategoryModel extends Model {
protected $trueTableName = 'top_categories';
}</code></pre>
注意trueTableName 需要完整的表名定义。
除了数据表的定义外，还可以对数据库进行定义（用于操作当前数据库以外的数据表），例如
top.top_categories ：
<pre><code>class CategoryModel extends Model {
    //protected $tablePrefix = '';
    //protected $tableName = 'categories';
    protected $trueTableName = 'top_categories';
    protected $dbName = 'top';
}</code></pre>

系统的规则下，tableName会转换为小写定义，但是trueTableName定义的数据表名称是保持原样。
因此，如果你的数据表名称需要区分大小写的情况，那么可以通过设置trueTableName定义来解决。
*/
