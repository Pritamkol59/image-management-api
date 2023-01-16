import React ,{ useState } from 'react'
//rafce
import "../assets/css/login-form.css"
import "../assets/css/login-form-1.css"
import Dash from './Dash';
const Login = () => {
    const [formData, setFormData] = useState({ email: '', password: '' });
    const [Token, setToken] = useState(false);

    const handleSubmit = (event) => {
        event.preventDefault();
        fetch('http://127.0.0.1:8000/api/login', {
          method: 'POST',
          body: JSON.stringify(formData),
          headers: { 'Content-Type': 'application/json' },
        })
        .then(response => response.json())
        .then(data => {
            // handle response here
           // console.log(data.token);
            localStorage.setItem('token', data.token);
            const token = localStorage.getItem('token');
            console.log(token);
            setToken(token);
            //localStorage.removeItem('token');
        });
      }

  return (
    <>
    <div className='tt'></div>
    {!Token?<div className="container full-height">
        <div className="row flex center v-center full-height">
            <div className="col-8 col-sm-4">
                <div className="form-box">
                    <form onSubmit={handleSubmit}>
                        <fieldset>
                            <legend>Sign in</legend>
                            <img id="avatar" className="avatar round" src="https://w7.pngwing.com/pngs/831/88/png-transparent-user-profile-computer-icons-user-interface-mystique-miscellaneous-user-interface-design-smile-thumbnail.png"/>
                            <input className="form-control" type="text" value={formData.email} onChange={event => setFormData({ ...formData, email: event.target.value })} placeholder="username" required/>
                            <input className="form-control" type="password" value={formData.password} onChange={event => setFormData({ ...formData, password: event.target.value })} placeholder="password" required/>
                            <button className="btn btn-primary d-block w-100" type="submit">LOGIN </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>:<Dash/>}
    </>
  )
}

export default Login