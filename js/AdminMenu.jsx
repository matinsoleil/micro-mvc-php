var imported = document.createElement('script');
imported.src = 'https://unpkg.com/react@16/umd/react.development.js';
document.head.appendChild(imported);

var property = document.createElement('script');
property.src = 'https://cdnjs.cloudflare.com/ajax/libs/prop-types/15.6.2/prop-types.min.js';
document.head.appendChild(property);

class AdminMenu extends React.Component {
 render(){
 return(<h1 name={this.props.attribute} >Hijo, {this.props.name}</h1>);
 }

}


AdminMenu.propTypes = {
  name: PropTypes.string,
  attribute: PropTypes.string
};

