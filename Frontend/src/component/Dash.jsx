import React ,{ useState , useEffect}  from 'react';
import Modal from 'react-modal';
//import { useHistory } from 'react-router-dom';
import axios from 'axios';
import "../assets/css/Bootstrap-DataTables.css"
//import Table from './Table';
const Dash = () => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [isNewModalOpen, setIsNewModalOpen] = useState(false);
  const [dataload, setDataload] = useState(false);
  const [description, setDescription] = useState('');
  const [title, setTitle] = useState('');
  const [image, setImage] = useState('');

  const [description1, setDescription1] = useState('');
  const [title1, setTitle1] = useState('');
  const [image1, setImage1] = useState('');
  const [id1, setid1] = useState('');

  const [data, setData] = useState([]);
    const [data2, setData2] =  useState([]);
    const apis='http://127.0.0.1:8000/';


  //const history = useHistory();

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





    setDataload(true);
    

  }, [dataload]);



  async function handleSubmit(event) {
    event.preventDefault();
    

    try {

      const formData = new FormData();
      formData.append('description', description);
      formData.append('title', title);
      formData.append('img', image);

      const token = localStorage.getItem('token');

      const response = await axios.post('http://127.0.0.1:8000/api/cimages', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${token}`
        }
      });

      //history.push(`/cimages/${response.data.id}`);
      console.log(response.data);
      setIsModalOpen(false);
      setDataload(false);
    } catch (error) {
      console.log(error);
    }
  }


  async function handleSubmit2(event) {
    event.preventDefault();
    

    try {

      const formData = new FormData();
      formData.append('description', description1);
      formData.append('title', title1);
      formData.append('img', image1);
      formData.append('id', id1);

      const token = localStorage.getItem('token');

      console.log(image1);

      const response = await axios.post('http://127.0.0.1:8000/api/imagesup', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
          Authorization: `Bearer ${token}`
        }
      });

      //history.push(`/cimages/${response.data.id}`);
      console.log(response.data);
      setIsNewModalOpen(false);
      setDataload(false);
    } catch (error) {
      console.log(error);
    }
  }

const deletItem =async(id)=>{
const idx= id.id;

try{

  const formData = new FormData();
 
  formData.append('id', idx);

  const token = localStorage.getItem('token');

  console.log(token);
  const response = await axios.post('http://127.0.0.1:8000/api/imgdel/',formData, {
    headers: {
      'Content-Type': 'multipart/form-data',
      Authorization: `Bearer ${token}`
    }
  });
  

  console.log(response.data);
  setDataload(false);

}
catch(error) {
  console.log(error);
}


}

  const handleEdit = (item) => {
    console.log(item);
    //setData2([item]);
    setTitle1(item.title);
    setDescription1(item.description);
    setImage1(item.image_url);
    setid1(item.id);
    //console.log(data2.title);
    setIsNewModalOpen(true);


    
  };

  const Logout=()=>{

    localStorage.removeItem('token');
    setDataload(false);

  }


  return (
    <>
    <div className='hder'>Dash</div>
    <div className='ff'>
    <button className="btn btn-success" onClick={() => setIsModalOpen(true)}>
        Add item 
      </button>
      </div>
      <Modal
        isOpen={isModalOpen}
        onRequestClose={() => setIsModalOpen(false)}
      >
        <h2>Add item</h2>

        <form onSubmit={handleSubmit}>
        <div className="mb-3">
  <label for="exampleFormControlInput1" className="form-label">Img Tittle</label>
  <input type="text" className="form-control" value={title} onChange={event => setTitle(event.target.value)} placeholder="name@example.com"/>
</div>
<div className="mb-3">
  <label for="exampleFormControlTextarea1" className="form-label">Img Description</label>
  <textarea className="form-control"value={description} onChange={event => setDescription(event.target.value)} rows="3"></textarea>
</div>
<div className="mb-3">
  <label for="exampleFormControlTextarea1" className="form-label">Upload Img</label>
  <input type="file" onChange={event => setImage(event.target.files[0])} className="form-control" />
</div>



<button className="btn btn-primary d-block w-100" type="submit">Submit </button>
</form>


        <button onClick={() => setIsModalOpen(false)}>
          Close Modal
        </button>
      </Modal>
      {dataload?<div className='cc'>


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
      <td><button className="btn btn-danger d-block w-100" onClick={()=>deletItem(item)} >Delete </button> </td>
    </tr>
    ))}
  
  </tbody>
</table>

<Modal
        isOpen={isNewModalOpen}
        onRequestClose={() => setIsNewModalOpen(false)}
      >
        <h2>Update item</h2>

         <form onSubmit={handleSubmit2}>
        <div className="mb-3" >
          <label for="exampleFormControlInput1" className="form-label">Img Tittle</label>
          <input type="text" className="form-control" value={title1} onChange={event => setTitle1(event.target.value)} placeholder="name@example.com"/>
        </div>
        <div className="mb-3">
          <label for="exampleFormControlTextarea1" className="form-label">Img Description</label>
          <textarea className="form-control"value={description1} onChange={event => setDescription1(event.target.value)} rows="3"></textarea>
        </div>
        <div className="mb-3">
          <label for="exampleFormControlTextarea1" className="form-label">Upload Img</label>
          <input type="file"  onChange={event => setImage1(event.target.files[0])} className="form-control" />
        </div>
        <input hidden type="text" className="form-control" value={id1} onChange={event => setid1(event.target.value)} placeholder="name@example.com"/>
        <button className="btn btn-primary d-block w-100" type="submit">Submit </button>
      </form> 


        <button onClick={() => setIsNewModalOpen(false)}>
          Close Modal
        </button>
      </Modal>

   
</div>:null} 







    </>
  )
}

export default Dash