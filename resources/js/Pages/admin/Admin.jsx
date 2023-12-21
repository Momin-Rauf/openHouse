import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import { useState } from 'react';
import InputError from '@/Components/InputError';
import GroupCard from './GroupCard';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Admin({groups,guests,projects}) {
  const [group,setgroup] = useState([]);
  const [guest,setguest] = useState([]);
  const [project,setproject] = useState([]);
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);


    useEffect(() => {
        const fetchGroups = async () => {
            setgroup(groups);
            setguest(guests);
            setproject(projects);
         
        
        };

        fetchGroups();
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('create_user'));
    };

    return (
        <>
        <GuestLayout>
            <Head title="Register" />
            <h1 className='font-xl font-bold' >ADD GUEST OR GROUP</h1>
            <form className='bg-gray-200 w-[80%] p-12 rounded-md shadow-sm shadow-black' onSubmit={submit}>
               <div className='flex p-10 rounded-lg flex-row justify-center gap-7 items-center w-[100%] bg-gray-300' >
               <div className='w-[50%] ' >
                    <InputLabel htmlFor="name" value="Name" />

                    <TextInput
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>




                <div className='w-[50%]'>
                    <InputLabel htmlFor="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />

                    <InputError message={errors.email} className="mt-2" />
                </div>
               </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password_confirmation" value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        required
                    />

                    <InputError message={errors.password_confirmation} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="role" value="role" />

                    <TextInput
                        id="role"
                        name="role"
                        value={data.role}
                        className="mt-1 block w-full"
                        autoComplete="role"
                        isFocused={true}
                        onChange={(e) => setData('role', e.target.value)}
                        required
                    />

                    <InputError message={errors.role} className="mt-2" />
                </div>

                <div className="flex items-center justify-end mt-4">
                    <Link
                        href={route('login')}
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton className="ms-4" disabled={processing}>
                        Register
                    </PrimaryButton>
                </div>
            </form>


            <h1>Groups</h1>
            <div className='bg-blue-400 shadow-sm flex gap-5 flex-col p-10   shadow-black w-[50%] h-auto'>
    {
        group.map((g, index) => (
            <GroupCard key={index} name={g.name} />
        ))
    }
</div>


<h1>GUESTS</h1>
<div className='bg-blue-400 shadow-sm flex gap-5 flex-col p-10   shadow-black w-[50%] h-auto'>
    
    {
        guests.map((g, index) => (
            <GroupCard key={index} name={g.name} />
        ))
    }
</div>


<h1>Projects</h1>
<div className='bg-blue-400 shadow-sm flex gap-5 flex-col p-10   shadow-black w-[50%] h-auto'>
    
    {
        project.map((g, index) => (
            <GroupCard key={index} name={"Project_id:"+ g.id+ "==>Rating:" + g.rating} />
        ))
    }
</div>

        </GuestLayout>

        



        

        </>
    );
}
