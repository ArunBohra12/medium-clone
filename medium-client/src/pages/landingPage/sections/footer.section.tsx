import mediumLogo from '../../../assets/images/wordmark.svg';

import './footer.styles.scss';

const Footer = (): JSX.Element => {
  return (
    <footer className="footer">
      <img className="footer-img" src={mediumLogo} alt="Medium" />;
    </footer>
  );
};

export default Footer;
