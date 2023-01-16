import { useState ,useEffect } from 'react'
import Dash from './component/Dash';
//import reactLogo from './assets/react.svg'
//import './App.css'
import Login from './component/Login'
function App() {
  const [active, setActive] = useState(false);

  useEffect(() => {
    const token = localStorage.getItem('token');
    if(token){
      setActive(true);
    }
  }, []);

  return (
    <>
    
    {!active?<Login />:<Dash />}
    </>
    
  )
}

export default App
