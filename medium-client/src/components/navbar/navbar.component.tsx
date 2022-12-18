import { Link } from 'react-router-dom';

import Button from '../button/button.component';
import logo from '../../assets/images/logo.svg';

import './navbar.styles.scss';

const Navbar = (): JSX.Element => {
  return (
    <div className="navbar">
      <img className="navbar-logo" src={logo} alt="Medium" />

      <nav className="navbar-links">
        <Link to="/signin">Sign In</Link>
      </nav>

      <Button>Get started</Button>
    </div>
  );
}

export default Navbar;
