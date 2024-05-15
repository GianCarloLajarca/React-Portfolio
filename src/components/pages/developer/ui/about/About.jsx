import React from 'react'
import { baseImgUrl, devBaseImgUrl } from '../../../../helpers/functions-general'
import { MdOutlineHorizontalRule } from 'react-icons/md'
import useQueryData from '../../../../custom-hook/useQueryData';

const About = () => {

  const {
    isLoading,
    isFetching,
    error,
    data: about,
  } = useQueryData(
   "/v1/about", // endpoint
   "get", // method
    "about", // key
  );

  return (
    <>
        <section className='aboutMe py-24 bg-darkblue grid place-items-center'>
        {about?.data.map((item, key) => (
        <div className="container grid grid-cols-2 gap-36 justify-center items-center place-items-center" key={key}>
              <div className='aboutme-image size-[500px]'>
               <img src={`${devBaseImgUrl}/${item.about_photo}`} alt="" />
              </div>
              <div className='aboutme-content flex flex-col gap-10'>
                <h2 className='flex gap-2 items-center text-accent text-2xl tracking-wide uppercase'><MdOutlineHorizontalRule />{item.about_title}</h2>
                <p className='text-justify'>{item.about_description}</p>

                <p className='text-justify'>{item.about_detail}</p>

                <ul className='flex flex-col gap-3'>
                  <li className='flex gap-24'>Name: <span>{item.about_name}</span></li>
                  <li className='flex gap-24'>Email: <span>{item.about_email}</span></li>
                  <li className='flex gap-[5.9rem]'>Phone: <span>{item.about_phone}</span></li>
                  <li className='flex gap-[3.2rem]'>Date of Birth: <span>{item.about_birthday}</span></li>
                  <li className='flex gap-[4rem]'>Nationality: <span>{item.about_nationality}</span></li>
                  <li className='flex gap-[5rem]'>Address: <span>{item.about_address}</span></li>
                </ul>

                <div className='aboutme-btn flex flex-row gap-12'>
                    <button className='uppercase bg-accent py-2 px-10 text-primary font-semibold  border border-accent hover:bg-transparent hover:text-white hover:border hover:border-light transition-all'>Hire me</button>
                    <a href={`${baseImgUrl}/home/resume-1.png`} data-lightbox="image-1" data-title="Resume" className='py-4 px-10 uppercase bg-accent text-primary font-thick w-48 text-center 
             border border-accent hover:bg-transparent hover:text-white hover:border hover:border-light transition-all'>View Resume</a>
                </div>
              </div>
        </div>
         ))} 
        </section>
    </>
  )
}

export default About