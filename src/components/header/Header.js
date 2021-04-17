import './Header.css';
import SearchBar from '../searchbar/SearchBar';
import Logo from '../../asssets/logo.png'
import Cities from '../cities/Cities'



function Header() {
    return(
        <div className="header-container">
            <div className="username-auth">
                <span className="username">Username</span> <span className="auth">SIGN OUT</span>
            </div>
         
            <br/>
            <img src={Logo} alt="logo noqueue"/>
            <br/>
            <div className="cities-searchbar-container">
            <Cities /> <SearchBar />
            </div>
          

        </div>
    );

}

export default Header;