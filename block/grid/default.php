<?php

$grid = array('master','combo','top','helper','build','task');

?>
<?php if($this->scripts()): ?>
<script src="./js/react.development.js"></script>
<script src="./js/react-dom.development.js"></script>
<script src="./js/babel.min.js"></script>
<script src="./js/prop-types.min.js"></script>
<script type="text/jsx" src="./js/AdminMenu.jsx"></script>
<div id="root"></div>
<?php endif; ?>

<script type="text/jsx">

class Item extends React.Component {
  render() {
    return (
      [<div key={this.props.title}  className="title">Name</div>,
      <div key={this.props.item} className="item" >
          CHILD
      </div>]
    );
  }
}

  Item.propTypes = {
  title: PropTypes.string,
  item: PropTypes.string
};


</script>
<script type="text/jsx" >

class Grid extends React.Component {
  render() {
    return (
      <div className="grid" >
        <?php foreach($grid as $key=>$item): ?>
                 <Item item='<?php echo $key ?>tm' title='<?php echo $key ?>tl'  />
                 <span><?php echo $item; ?></span>
        <?php endforeach; ?>
      </div>
    );
  }
}

var format="horizontal";

</script>

<?php if(TRUE): ?>

<script  type="text/jsx" >

  ReactDOM.render(
    <div><Grid key='start' type={format} /><AdminMenu name='master' attribute='help' /></div>,
    document.getElementById('root')
  );

</script>
<?php endif; ?>
