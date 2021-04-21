import "./Dropdown.css";
import { Component } from "react";

class Dropdown extends Component {
  constructor() {
    super();

    this.state = {
      displayMenu: false,
    };

    this.showDropdownMenu = this.showDropdownMenu.bind(this);
    this.hideDropdownMenu = this.hideDropdownMenu.bind(this);
  }

  showDropdownMenu(event) {
    event.preventDefault();
    this.setState({ displayMenu: true }, () => {
      document.addEventListener("click", this.hideDropdownMenu);
    });
  }

  hideDropdownMenu() {
    this.setState({ displayMenu: false }, () => {
      document.removeEventListener("click", this.hideDropdownMenu);
    });
  }

  render() {
    return (
      <div className="dropdown">
        <div className="button" onClick={this.showDropdownMenu}>
          Location
        </div>

        {this.state.displayMenu ? (
          <ul>
            <li>
              <a className="active" href="#Bogor">
                Bogor
              </a>
            </li>
            <li>
              <a href="#Jakarta">Jakarta</a>
            </li>
            <li>
              <a href="#Depok">Depok</a>
            </li>
            <li>
              <a href="#Bekasi">Bekasi</a>
            </li>
          </ul>
        ) : null}
      </div>
    );
  }
}
export default Dropdown;
