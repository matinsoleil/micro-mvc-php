<html id='html'>
<head id='head'>
<title>default</title>
<link id='style' rel="stylesheet" type="text/css" href="./style/default.css">
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
<div id='footer'></div>
</body>
</html>
