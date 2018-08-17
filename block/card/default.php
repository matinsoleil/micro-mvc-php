<script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<script crossorigin src="https://cdnjs.cloudflare.com/ajax/libs/prop-types/15.6.2/prop-types.min.js"></script>
<script>


class Card extends React.Component {
 render(){
 return(<h1 name={this.props.attribute} >Hijo, {this.props.name}</h1>);
 }

}


Card.propTypes = {
  name: PropTypes.string,
  attribute: PropTypes.string
};

export default Card;

</script>