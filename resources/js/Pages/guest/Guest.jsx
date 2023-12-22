import React, { useEffect } from 'react'
import { useState } from 'react';
import { useForm } from '@inertiajs/inertia-react';
import { Link } from '@inertiajs/react';

const Guest = ({projects}) => {
  const { data, setData, post, processing, errors, reset } = useForm({
    rate: undefined,
    id: '',
  });
  const [project,setprojects] = useState([]);

  useEffect(()=>{
    const setfunc =()=>{
      setprojects(projects);
    console.log(projects);  
    }
    setfunc();
  },[]);


  const submitHandler= (e)=>{
    e.preventDefault();
    // setData('id',id);
    post(route('rate.project'));
  }

  const idSubmit = (id)=>{
      setData('id',id);
    }

    
    {console.log(project)}
  return (
    <div className='bg-blue-400 flex flex-col justify-center items-center h-[100vh] ' >{
      
      project.map((x,index)=>{
        // {setData('id',x.id);}
        return(
          <form key={index} className='flex flex-col bg-blue-500 justify-center items-center p-24 rounded-lg shadow-md shadow-black' onSubmit={submitHandler} >
            <div>
            <h1>Project Assigned :{x.name}</h1>
            <p> Prefernce: {x.assigned_words}</p>
            
            {/* {setData('id',x.id)} */}
            <label htmlFor="">Rate it out of 10</label>

            <input value={data.rate} className='m-4 rounded-md' onChange={(e)=>{setData('rate',e.target.value)}} type="number"/>
            <button className='relative bg-blue-900 rounded-md text-white p-3 mt-10' type='submit' onClick={()=>idSubmit(x.id)} >Submit</button>
            
          </div>
          </form>
        )
      })
    }
   <Link
  href={route('logout.guest')}
  
  className="absolute top-[-4%] right-5 bg-blue-900 rounded-md text-white p-3 mt-10"
>
  Logout
</Link>
    </div>
  )
}

export default Guest