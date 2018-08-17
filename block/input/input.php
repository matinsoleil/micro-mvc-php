<?php

?>
<script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<script crossorigin src="https://cdnjs.cloudflare.com/ajax/libs/prop-types/15.6.2/prop-types.min.js"></script>
<script type="text/jsx" src="http://macrocomer.mx/js/AdminMenu.jsx" ></script>
<?php

?>
<div id="root"></div>
<div id="tree"></div>
<script type="text/jsx" >
    
    
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
