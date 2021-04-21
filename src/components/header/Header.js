import "./Header.css";
import SearchBar from "../searchbar/SearchBar";
import Logo from "../../asssets/logo.png";
import Dropdown from "../dropdown/Dropdown";

function Header() {
  return (
    <div className="header-container">
      <img src={Logo} alt="logo noqueue" />
      <div className="auth-container">
        <a className="masuk" href="/">
          Masuk
        </a>
        <a className="daftar" href="/">
          Daftar
        </a>
      </div>
      <div className="center-container">
        <div className="judul-motto">
          <span className="judul">NoQ!</span>
          <span className="motto">Makan enak tanpa antre</span>
        </div>
        <div className="location-search-container">
          <Dropdown />
          <SearchBar />
        </div>
      </div>
    </div>
  );
}

export default Header;
