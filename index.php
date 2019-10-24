<?php
ob_start();
session_start();
ini_set('display_errors','On');
//error_reporting(0);
//set_time_limit(0);//设置超时，0表示不限时
date_default_timezone_set('PRC');//中国时区 

function BT($str)
{
$str=strip_tags($str);
echo '<script language="JavaScript" type="text/javascript">webBt="'.$str.'";document.title=webBt;</script>';
}
?>
<?php
//在这里写页面函数
//main作为首页
function main(){
//用BT函数设置文档标题
BT("欢迎光临xx网站，这是文档标题");
echo "<h3>这是标题</h3>";
echo "<div>hello,这是首页</div>";
}
//这是第二页
function pg2()
{
//用BT函数设置文档标题
BT("欢迎光临xx网站第二页，这是文档标题");
echo "<h3>这是标题2</h3>";
echo "<div>hello,这是第二页</div>";

}
//这是第3页
function pg3()
{
//用BT函数设置文档标题
BT("欢迎光临xx网站第3页，这是文档标题");
echo "<h3>这是标题3</h3>";
echo "<div>hello,这是第3页</div>";

}



//lf可以提供纯php页面，比如异步请求生成json或xml数据
//url这样写?lf=函数名，如?lf=getjson，然后写个getjson函数。function getjson(){}
//参数传入在url中加入，如?lf=getjson&a=1;在getjson函数中获取$a=$_GET["a"];

if(isset($_GET["lf"])){
	$f=$_GET["lf"];
	$f();
}else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no">
<title>远程操控台</title>
<script type='text/javascript'>
window.addEventListener('error',function(e){
myLog("错误:"+e.message+",\n"+e.stack+",\n名称:"+e.name+",\n文件:"+e.filename+"\n行："+e.lineno);
    });
</script>
<script>
function jid(id)
{
if(!document.getElementById(id)){
console.dir(id+"不存在");
}
return document.getElementById(id);
}

function ap(h,obj,kb)
{
if(kb==1){
obj.innerHTML="";
}
if(typeof(h)=="string"){
var obj_dom=cel(h);
}else
{
var obj_dom=h;
}
var arr=[];
for(var ik=0;ik<obj_dom.length;ik++){
arr.push(obj_dom[ik]);
}
if(kb==1||kb==0){
for(var ik=0;ik<arr.length;ik++){		obj.appendChild(arr[ik]);
}
}else if(kb==3){//前插入
var parent = obj.parentNode;
for(var ik=0;ik<arr.length;ik++){				//parent.appendChild(arr[ik]);		parent.insertBefore(arr[ik], obj);
}
}//if
else if(kb==4){
var parent = obj.parentNode;
if (parent.lastChild == obj) {
for(var ik=0;ik<arr.length;ik++){			parent.appendChild(arr[ik]);		
}
}else {
for(var ik=0;ik<arr.length;ik++){				parent.insertBefore(arr[ik], obj.nextSibling);
}
}
}else if(kb==5){//内部前插入
var os = obj.children;
if(os.length>0)
{
var oFirst=os[0];
for(var ik=0;ik<arr.length;ik++){
				obj.insertBefore(arr[ik], oFirst);
}
}
else
{
for(var ik=0;ik<arr.length;ik++){
					obj.appendChild(arr[ik]);				
}
}
		
		
}
	
}
function cel(h){
var objcel=document.createElement("div");
objcel.innerHTML=h;
return objcel.childNodes;
}

function jpost(js)
{
/*
if(window.navigator.onLine==false){alert("当前网络离线，请检查网络");}
*/
	var url=js.url;
	var data=js.data;
	var cb=js.cb;
//tsB('<img src="image/system/downing.gif" width="50" />');
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {

  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
var rs=xmlhttp.responseText;
//alert(rs);
//console.log(rs);
eval(cb).apply(this,[rs]);
		//---------------------------------
var html = rs;  
if(!jid("script1")){
ap('<div id="script1" style="display:none;"></div>',document.body,0);
}
var hd=jid("script1");
hd.innerHTML='';
var re = /(?:<script([^>]*)?>)((\n|\r|.)*?)(?:<\/script>)/ig;    
		var srcRe = /\ssrc=([\'\"])(.*?)\1/i;    
		var typeRe = /\stype=([\'\"])(.*?)\1/i;    
var match;    
while(match = re.exec(html)){    
var attrs = match[1];    
var srcMatch = attrs ? attrs.match(srcRe) : false;    
if(srcMatch && srcMatch[2]){    
var s = document.createElement("script");    
s.src = srcMatch[2];
var typeMatch = attrs.match(typeRe);    
				  if(typeMatch && typeMatch[2]){    
					   s.type = typeMatch[2];    
}    
				  hd.appendChild(s);    
}else if(match[2] && match[2].length > 0){    
				  if(window.execScript) {    
		window.execScript(match[2]);    
} else {    
					 window.eval(match[2]);    
 }    
}    
}
		//---------------------------------
}
if(xmlhttp.status==500){
alert(500);
}
}
xmlhttp.onerror=function(){
jpost(js);
};
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(data);
}
</script>
<style type="text/css">
h3{text-align:center;}
.form1{padding:10px;text-align:center;}
.form1 input[type=button]{
padding:15px;
margin:5px;
background-color:#FF6600;
color:#FFFFFF;
}
</style>
</head>

<body>
<!--可以写固定的头,也可以在页面函数中写-->
<div class="top">
<div class="nav">
<a href="?f=main">
首页
</a>
<a href="?f=pg2">
页面2
</a>
<a href="?f=pg3">
页面3
</a>
</div>
</div>
<div>
<?php
if(!empty($_GET)&&!empty($_GET["f"])){
$f=$_GET["f"];
}
else
{
$f="main";
}
$f();
?>
</div>
<div class="foot">
这是共用的脚
</div>
</body>
</html>
<?php } ?>