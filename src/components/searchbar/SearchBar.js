import './SearchBar.css';


function SearchBar() {
    return (
        <div className="search">
            <input type="text" placeholder="Find your nearest restaurant" className="text"/>
        </div>
    );
}

export default SearchBar;