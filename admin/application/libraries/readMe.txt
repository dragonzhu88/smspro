---------------------------
Action.php      罗列Action操作
Command.php     罗列Command操作
config.php      配置类，填写设备IP 以及用户名，密码
Connection      连接类，用于发送POST,GET请求，注意构造方法
Conponent.php   为了组合字符串，addStr返回自己，继续addStr，最后通过getValue方法得到字符串
Flag.php        罗列Flag操作
listening.php   监听服务器推送，其实就是把推送过来的打印到json.txt中
Example.php     测试用例
UrlMaker.php    组装get请求
===========================
Action.php   	Option list for Action
Command.php  	Option list for Command
config.php   	Config Class，need your user_name, password and base_url
Connection   	Connection Class， to make a POST request or a GET request ，please pay attention to construction method
Conponent.php 	Combination Strings
Flag.php     	Option list for Flag
listening.php	listening.php is responsible for monitoring and instrument data sent by the SERVER, stored in the json.txt
Example.php     All test cases
UrlMaker.php  	packaging GET request
