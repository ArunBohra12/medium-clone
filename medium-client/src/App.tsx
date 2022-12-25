import { Route, Routes } from 'react-router-dom';

import Navbar from './components/navbar/navbar.component';
import AuthPage from './pages/auth/auth.page';
import LandingPage from './pages/landingPage/home.page';

import './sass/main.scss';

const App = (): JSX.Element => {
  return (
    <>
      <Routes>
        <Route
          path="/"
          element={
            <>
              <Navbar />
              <LandingPage />
            </>
          }
        />
        <Route path="/auth" element={<AuthPage />} />
      </Routes>
    </>
  );
};

export default App;
