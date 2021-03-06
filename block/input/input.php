<?php
//<script id="adminMenu" type="text/jsx" src="./js/AdminMenu.jsx" ></script>
if($this->scripts()):
include('./block/script/default.php');
endif;
?>
<script id="input" type="text/jsx" >

class Clock extends React.Component {
  constructor(props) {
    super(props);
    this.state = {date: new Date()};
  }

  componentDidMount() {
    this.timerID = setInterval(
      () => this.tick(),
      1000
    );
  }

  componentWillUnmount() {
    clearInterval(this.timerID);
  }

  tick() {
    this.setState({
      date: new Date()
    });
  }

  render() {
    return (
      <div>
        <h1>Hello, world!</h1>
        <h2>It is {this.state.date.toLocaleTimeString()}.</h2>
      </div>
    );
  }
}

</script>
<?php if($this->scripts()):?>
<script  type="text/jsx" >
ReactDOM.render(<Clock/>,document.getElementById('root'));
</script>
<?php endif; ?>
