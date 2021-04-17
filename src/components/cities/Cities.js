import DropdownButton from 'react-bootstrap/DropdownButton'
import Dropdown from 'react-bootstrap/Dropdown';
import 'bootstrap/dist/css/bootstrap.min.css';

function Cities() {
    return (
        <div>
            <DropdownButton id="dropdown-variants-Primary" variant="primary" title="Bogor">
                <Dropdown.Item title="Jakarta">Bogor</Dropdown.Item>
                <Dropdown.Item title="Depok">Jakarta</Dropdown.Item>
                <Dropdown.Item title="Bekasi">Depok</Dropdown.Item>
            </DropdownButton>
        </div>
    );
}

export default Cities;