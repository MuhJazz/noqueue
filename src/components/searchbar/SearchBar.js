import "./SearchBar.css";

function SearchBar() {
  return (
    <div className="searchbar">
      <input
        type="text"
        placeholder="Find your nearest restaurant..."
        className="text"
      />
    </div>
  );
}

export default SearchBar;
