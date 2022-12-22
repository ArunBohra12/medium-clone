import { Link } from 'react-router-dom';

import './button.styles.scss';

type ButtonProps = {
  children: React.ReactNode;
  variant?: string;
  type?: 'link' | 'button';
  buttonAttributes?: React.HTMLAttributes<HTMLButtonElement>;
  link?: string;
  linkAttributes?: React.HTMLAttributes<HTMLAnchorElement>;
};

const buttonVariants: { [variant: string]: string } = {
  black: 'btn-black',
  green: 'btn-green',
  'light-green': 'btn-light-green',
};

const Button = ({
  children,
  variant = 'black',
  type = 'button',
  buttonAttributes,
  linkAttributes,
  link,
}: ButtonProps): JSX.Element => {
  if (type === 'link' && link) {
    return (
      <Link to={link} className={`btn ${buttonVariants[variant] ?? ''}`} {...linkAttributes}>
        {children}
      </Link>
    );
  }

  return (
    <button className={`btn ${buttonVariants[variant] ?? ''}`} {...buttonAttributes}>
      {children}
    </button>
  );
};

export default Button;
