import React, { useEffect, useState } from 'react';
import { useForm } from '@inertiajs/inertia-react';

const Group = ({projectDetails,projectRatings}) => {
  const [word, setWord] = useState('');
  const [rating,setRating] = useState([]);
  const [details,setDetails] = useState([]);
  const { data, setData, post, processing, errors, reset } = useForm({
    Projectname: '',
    word: '',
  });

  useEffect(()=>{
    const x = () =>{
      setRating(projectRatings);
    setDetails(projectDetails);
    console.log(projectDetails);
    }

    x();
  },[]);
  const wordSubmit = (e) => {
    e.preventDefault();
    post(route('assign.word'));
  };

  return (
    <div className='bg-blue-400  h-[100vh] flex flex-col justify-center items-center' >
      <form className='bg-blue-600 shadow-md shadow-black p-10 rounded-lg m-12 flex flex-col' onSubmit={wordSubmit}>
        <label htmlFor="projectName">Project Name</label>
        <input className='rounded-lg pl-4 '
          id="projectName"
          name="Projectname"
          value={data.Projectname}
          onChange={(e) => setData('Projectname', e.target.value)}
          type="text"
        />
        <label className='mt-10' htmlFor="assignWord">Assign Word</label>
        <input className='rounded-lg pl-4 '
          id="assignWord"
          name="word"
          value={data.word}
          onChange={(e) => setData('word', e.target.value)}
          type="text"
        />
        <button className='bg-blue-900 w-[70%] p-2 rounded-[20px] hover:scale-105 hover:bg-blue-950 text-white mt-10 m-auto ' type="submit">Assign Project</button>
      </form>

      <div >
        <h1 className='font-bold text-xl ' >Your Projects:</h1>
      <p>Your Project Name:{
        details && details.name
      }</p>
     <p>
      Project Rating:
     {
        rating && rating
      }
     </p>

     <p>
      Project Assigned Word:
     {
        details.assigned_words
      }
     </p>
        
       
       
      </div>
      <Link
  href={route('logout.group')}
  
  className="absolute top-[-4%] right-5 bg-blue-900 rounded-md text-white p-3 mt-10"
>
  Logout
</Link>
    </div>
  );
};

export default Group;
