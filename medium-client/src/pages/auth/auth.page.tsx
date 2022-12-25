import { useState } from 'react';

import SignIn from '../../components/auth/signIn.component';
import SignUp from '../../components/auth/signUp.component';

import './auth.styles.scss';

const AuthPage = (): JSX.Element => {
  const [authPage, setAuthPage] = useState<'signin' | 'signup'>('signin');

  return (
    <div className="auth-page">
      <div className="auth-container">
        {authPage === 'signin' ? <SignIn setAuthPage={setAuthPage} /> : <SignUp setAuthPage={setAuthPage} />}
      </div>
    </div>
  );
};

export default AuthPage;
