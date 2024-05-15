import React from 'react'
import { MdArrowRightAlt, MdDownload, MdEmail, MdOutlineHorizontalRule } from 'react-icons/md';
import Header from '../header/Header';
import { FaFacebook, FaGithub, FaInstagram, FaLinkedin, FaTwitter } from 'react-icons/fa';
import { baseImgUrl, devBaseImgUrl } from '../../../../helpers/functions-general';
import useQueryData from '../../../../custom-hook/useQueryData';

const Banner = () => {

  const {
    isLoading,
    isFetching,
    error,
    data: banner,
  } = useQueryData(
   "/v1/banner", // endpoint
   "get", // method
    "banner", // key
  );


    //download resume
  const handleDownloadResume = () => {
    const link = document.createElement('a');
    link.href = '../../img/home/CV-RESUME-LAJARCA.pdf';
    link.download = 'CV-RESUME-LAJARCA.pdf';
    link.click();
  };

  return (
    <>
        <section id='banner' className='h-screen w-screen'>
        <Header />
        {banner?.data.map((item, key) => (
    <div className='hero-banner grid grid-cols-2 gap-12 relative' key={key}>
        <div className='banner-content flex flex-col gap-8 ml-56 mt-64 '>
            <h3 className='flex gap-2 items-center text-accent text-2xl tracking-wide uppercase'><MdOutlineHorizontalRule />{item.banner_greet}</h3>
            <h1 className='text-5xl portfolio-name text-left w-fit inline-block'>I'm <span className='text-accent'>{item.banner_firstname}</span> {item.banner_lastname}</h1>
            <p className='w-auto leading-8'>This is <span className='text-accent'>{item.banner_name}</span> , {item.banner_description}</p>

             <button className='py-4  uppercase bg-accent text-primary font-thick w-48 text-center 
             border border-accent hover:bg-transparent hover:text-white hover:border hover:border-light transition-all
             flex gap-2 items-center justify-center' onClick={handleDownloadResume}>{item.banner_button} <span className='text-xl'><MdDownload /></span></button>
             <div className='hero-banner-icons flex items-end'>
              <ul className='flex flex-row gap-6 text-2xl mt-36'>
                <li className='cursor-pointer hover:text-accent transition-all'><FaFacebook /></li>
                <li className='cursor-pointer hover:text-accent transition-all'><FaLinkedin /></li>
                <li className='cursor-pointer hover:text-accent transition-all'><FaGithub /></li>
                <li className='cursor-pointer hover:text-accent transition-all'><FaInstagram /></li>
                <li className='cursor-pointer hover:text-accent transition-all'><FaTwitter /></li>
                <li className='cursor-pointer hover:text-accent transition-all'><MdEmail /></li>
              </ul>
            </div>
        </div>

        <div className='banner-profilepic object-cover size-[550px] '>
            <div className='banner-img'>
                <img src={`${devBaseImgUrl}/${item.banner_photo}`} alt="" className='absolute w-[700px] h-[800px] object-cover translate-y-[-0.5rem]'/>
            </div>
        </div>
      <div  className='banner-scroll rotate-90 absolute translate-y-[42rem] translate-x-[100rem] '>
            <h4 className='flex flex-row items-center gap-5 uppercase text-md text-accent font-normal' >Scroll Down <MdArrowRightAlt className='text-3xl'/></h4>
      </div>
    </div>
     ))}   
        </section>
    </>
  )
}

export default Banner