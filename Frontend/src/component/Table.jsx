import React, { useState, useEffect } from 'react';
import axios from 'axios';
import "../assets/css/Bootstrap-DataTables.css"
import Action from './Action';
import Dash from './Dash';
const Table = () => {
    const [data, setData] = useState([]);
    const [selectedId, setSelectedId] = useState(null);
    const apis='http://127.0.0.1:8000/';
    useEffect(() => {
        const fetchData = async () => {
          const token = localStorage.getItem('token');
          const result = await axios.get('http://127.0.0.1:8000/api/images', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          console.log(result.data.data);
          setData(result.data.data);
        };
        fetchData();
      }, []);

      const handleEdit = (id) => {
        setSelectedId(id);
      }

  return (
    <>
    
    <table className="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Pic</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">Action</th>
      <th scope="col">     </th>
      
    </tr>
  </thead>
  <tbody>
  {data.map(item => (
     
    <tr key={item.id} >
      <th scope="row">{item.id}</th>
      <td><img id="avatar" className="avatar round" src={apis+item.image_url}/></td>
      <td>{item.title}</td>
      <td>{item.description}</td>
      <td><button className="btn btn-primary d-block w-100" onClick={() => handleEdit(item)} >Edit </button> </td>
      <td><button className="btn btn-danger d-block w-100" >Delete </button> </td>
    </tr>
    ))}
  
  </tbody>
</table>
{ selectedId && <Dash isModalOpen={true} /> }

    </>
  )
}

export default Table