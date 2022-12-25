import FormGroup from '../formGroup/formGroup.component';
import Button from '../button/button.component';

type signupProps = {
  setAuthPage: React.Dispatch<React.SetStateAction<"signin" | "signup">>;
}

const SignUp = ({ setAuthPage }: signupProps): JSX.Element => {
  return (
    <>
      <h2 className="auth-heading">Join Medium.</h2>

      <form className="auth-form">
        <FormGroup label="Your name" inputAttributes={{ type: 'text', placeholder: 'John Smith' }} />
        <FormGroup label="Your email" inputAttributes={{ type: 'email', placeholder: 'example@example.com' }} />
        <FormGroup label="Your password" inputAttributes={{ type: 'password', placeholder: '********' }} />

        <Button type="submit" variant="black">Sign Up</Button>
      </form>

      <div className="change-auth-page">
        <p>Already have an account? <span className="navigate-auth-page" onClick={() => setAuthPage('signin')}>Sign in?</span></p>
      </div>
    </>
  );
};

export default SignUp;
