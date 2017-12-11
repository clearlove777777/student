# yyfframe
yyfframe
构建框架文件及目录（目录名全部用小写）

 |--app（开发者写代码的地方，实现功能的）
 
     |--index(前台部分)
        |--controller(控制器)
        |--view(模板)
     |--admin(后台部分)   
        |--controller(控制器)
        |--view(模板) 
     |--common(公共部分)             
 |--public(入口文件,静态资源)
 
     |--index.php(定义一个统一的入口文件，对外提供统一的访问文件)
     |--static(静态资源，存储助手函数，css,js,图片等)
        |--index(前台静态资源)
        |--admin(后台静态资源) 
     |--view(公共模板文件)
 |-- system(配置)
 
     |--config(需配置的文件目录)
     |--model(处理业务的各种模型目录)
 |--yyf(框架核心内容 封装的类)
  
      |--core(控制器，控制应用的流程)
      |--model(数据模型，封装的类)
      |--view(视图，生成页面返回给用户)   
    
    
    
    
    