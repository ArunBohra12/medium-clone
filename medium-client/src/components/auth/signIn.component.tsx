import FormGroup from '../formGroup/formGroup.component';
import Button from '../button/button.component';

type signinProps = {
  setAuthPage: React.Dispatch<React.SetStateAction<"signin" | "signup">>;
}

const SignIn = ({ setAuthPage }: signinProps): JSX.Element => {
  return (
    <>
      <h2 className="auth-heading">Welcome back.</h2>

      <form className="auth-form">
        <FormGroup label="Your email" inputAttributes={{ type: 'email', placeholder: 'example@example.com' }} />
        <FormGroup label="Your password" inputAttributes={{ type: 'password', placeholder: '********' }} />

        <Button variant="black">Sign In</Button>
      </form>

      <div className="change-auth-page">
        <p>No Account? <span className="navigate-auth-page" onClick={() => setAuthPage('signup')}>Create one</span></p>
      </div>
    </>
  );
};

export default SignIn;
