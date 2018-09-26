<html id='html'>
<head id='head'>
<title>default</title>
<link id='style' rel="stylesheet" type="text/css" href="./style/default.css">
<script charset="UTF-8" id='react' src="./js/react.development.js"></script>
<script charset="UTF-8" id='react' src="./js/react.development.js"></script>
<script charset="UTF-8" id='develop' src="./js/react-dom.development.js"></script>
<script charset="UTF-8" id='babel' src="./js/babel.min.js"></script>
<script charset="UTF-8" id='prop' src="./js/prop-types.min.js"></script>
<script charset="UTF-8" id='clock' type="text/jsx" src="./js/clock.js"></script>
<script charset="UTF-8" id='match' type="text/jsx">

var entity = React.createElement;

class Message extends React.Component{
  render(){
   return entity('div',{className:'message'},'Mensaje ' + this.props.message);
  }
}

class Hello extends React.Component {
  render() {
    return entity('div',{className:'sample'},'Mensaje de Bienvenida '+this.props.toWhat,entity(Message,{message:'hola'},null));
  }
}
ReactDOM.render(
  entity(Hello, {toWhat: 'World'}, null),
  document.getElementById('header')
);
</script>
</head>
<body id ='body'>
<div id='header'></div>
<div id='root'></div>
<style id="match" >
    
    .grid{
       float:left;
       width:100%;
     
       background-color:silver;
    }
    
    
    .one{
       float:left;
       width:100%;
       height:100%;
       margin:0%;
    }
    
    
    .two{
       float:left;
       width:50%;
       height:50%;
       margin:0%;
       
    }
    
     .three{
       float:left;
       width:33.333%;
       height:33.33%;
       margin:0%;
       
    }  
    
    
    .four{
       float:left;
       width:25%;
       height:25%;
       margin:0%;
        
    }
    
    
    
    @media only screen and (max-width: 600px) {
    body {
        background-color: lightblue;
         }  
     }
    
    
    
    
    .white{
        background-color: white;
    }
    
    .blue{
        background-color: blue;
    }
    
    .red{
        background-color: red;
    }
  
    .green{
        background-color: green;
    }
    
    
    .hb{
        width:400px;
         
    }
    
    
    .hm{
       width:200px; 
    }
    
    
    .hs{
       width:100px; 
        
    }
    
    
    
    .vb{
        height:400px;
         
    }
    
    
    .vm{
       height:200px; 
    }
    
    
    .vs{
       height:100px; 
        
    }  
    
    
    
 
    
    
    
</style>

<div class="grid">

   
    <div class="two white">
        <div class="two red hs vs" ></div>
         <div class="two blue hs vs" ></div>
         <div class="two red hs vs" ></div>
           <div class="two blue hs vs" ></div>
         <div class="two red hs vs" ></div>
         <div class="two blue hs vs" ></div>
    </div>

    <div class="two blue">
        <h2 class="one" >Hello world</h2>
        
    </div>
    
    <div class="two red">
       
        
    </div>
  
      <div class="two green">
       
        
    </div>
    
</div>
<div id='footer'></div>
</body>
</html>
