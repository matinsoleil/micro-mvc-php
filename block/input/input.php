<?php

$parameters =$this->parameters();
if(!isset($parameters['request']['block'])):
?>
<script src="./js/react.development.js"></script>
<script src="./js/react-dom.development.js"></script>
<script src="./js/babel.min.js"></script>
<script src="./js/prop-types.min.js"></script>
<div id="root"></div>
<?php
endif;
?>
<script id="adminMenu" type="text/jsx" src="./js/AdminMenu.jsx" ></script>
<script id="input" type="text/jsx" >

class Clock extends React.Component {
  render() {
    return (
      <div>
        <h1>Hello, world!</h1>
        <h2>It is {this.props.date.toLocaleTimeString()}.</h2>
      </div>
    );
  }
}

function tick() {
  ReactDOM.render(
    <div><Clock date={new Date()} /><AdminMenu name='master' attribute='help' /></div>,
    document.getElementById('root')
  );
}

setInterval(tick, 1000);
</script>

