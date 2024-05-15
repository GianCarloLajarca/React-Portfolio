import React from 'react'
import Navigation from '../../../../partials/Navigation'
import WelcomeTable from './WelcomeTable'
import useQueryData from '../../../../custom-hook/useQueryData'
import { MdContactPage, MdDashboard, MdOutlineCallToAction } from 'react-icons/md'
import { Link } from 'react-router-dom'
import { GiGraduateCap, GiSkills, GiVerticalBanner } from 'react-icons/gi'
import { SiAboutdotme } from 'react-icons/si'
import { IoIosBriefcase } from 'react-icons/io'
import { IoPersonSharp } from 'react-icons/io5'
import { FaCertificate } from 'react-icons/fa'
import { GrProjects } from 'react-icons/gr'
import Header from '../../../../partials/Header'

const Welcome = () => {

    const {
      data: about,
    } = useQueryData(
      "/v1/about", // endpoint
      "get", // method
      "about", // key
    );

    const {
        data: banner,
      } = useQueryData(
        "/v1/banner", // endpoint
        "get", // method
        "banner", // key
      );

      const {
        data: certificate, 
      } = useQueryData(
        "/v1/certificate", // endpoint
        "get", // method
        "certificate", // key
      );

      const {
        data: contact, 
      } = useQueryData(
        "/v1/contact", // endpoint
        "get", // method
        "contact", // key
      );

      
      const {
        data: cta, 
      } = useQueryData(
        "/v1/cta", // endpoint
        "get", // method
        "cta", // key
      );

      const {
        data: education, 
      } = useQueryData(
        "/v1/education", // endpoint
        "get", // method
        "education", // key
      );

      const {
        data: experience, 
      } = useQueryData(
        "/v1/experience", // endpoint
        "get", // method
        "experience", // key
      );

      const {
        data: honor, 
      } = useQueryData(
        "/v1/honor", // endpoint
        "get", // method
        "honor", // key
      );

      const {
        data: project, 
      } = useQueryData(
        "/v1/project", // endpoint
        "get", // method
        "project", // key
      );

      const {
        data: service, 
      } = useQueryData(
        "/v1/service", // endpoint
        "get", // method
        "service", // key
      );

      const {
        data: skill, 
      } = useQueryData(
        "/v1/skill", // endpoint
        "get", // method
        "skill", // key
      );

      const {
        data: top, 
      } = useQueryData(
        "/v1/top", // endpoint
        "get", // method
        "top", // key
      );


  return (
    <>

      <section className='flex overflow-x-hidden'>
      <aside className='px-4 py-6 w-[250px] text-primary h-screen border-r border-line'>
            <Navigation/>
      <ul className='nav'>
            <li className='nav-link active'><Link to="/dashboard"><MdDashboard />Dashboard</Link></li>
            <li className='nav-link'><Link to="/banner"><GiVerticalBanner />Banner</Link></li>
            <li className='nav-link'><Link to="/about"><SiAboutdotme/>About</Link></li>
            <li className='nav-link'><Link to="/service"><IoIosBriefcase/>Services</Link></li>
            <li className='nav-link'><Link to="/skill"><GiSkills/>Skills</Link></li>
            <li className='nav-link'><Link to="/education"><GiGraduateCap />Education</Link></li>
            <li className='nav-link'><Link to="/experience"><IoPersonSharp/>Experience</Link></li>
            <li className='nav-link'><Link to="/honor"><FaCertificate/>Honor Certifications</Link></li>
            <li className='nav-link'><Link to="/top"><FaCertificate/>Top Student Certifications</Link></li>
            <li className='nav-link'><Link to="/certificate"><FaCertificate/>Foundation Certifications</Link></li>
            <li className='nav-link'><Link to="/project"><GrProjects/>Projects</Link></li>
            <li className='nav-link'><Link to="/cta"><MdOutlineCallToAction/>Call To Action</Link></li>
            <li className='nav-link'><Link to="/contact"><MdContactPage/>Contact</Link></li>
        </ul>
        </aside>
        <main className='w-[calc(100%-250px)]'>
            <Header/>

        <div className='flex relative'>
            <div className={`main-wrapper transition-all px-4 py-3 max-h-[calc(100vh - 65px)] w-full `}>
                <div className='flex justify-between items-center'>
                    <h1>Welcome User</h1>
                    {/* <Searchbar setIsSeach={setIsSeach} setKeyword={setKeyword}/> */}
                </div>
            

                {/* <div className='tab flex justify-between items-center mt-8 border-b border-line mb-8 '> */}
                 

                    {/* <button className='btn btn--accent' onClick={handleAdd}>
                        <FiPlus/> New
                    </button> */}
                {/* </div> */}
                    {/* table here */}
                    {/* <ExpTable isLoading={isLoading} exp={exp} isFetching={isFetching} setItemEdit={setItemEdit}/> */}
                    <WelcomeTable certificate={certificate} honor={honor}
                    project={project} skill={skill} top={top} />
            </div>
             {/* database info */}
        </div>

        </main>
{/* 
        {store.isAdd && <ModalAddExp itemEdit={itemEdit}/>}
        {store.error && <ModalErrorEXP position='center'/>}
        {store.success && <Toast />} */}
    </section>

    </>
  )
}

export default Welcome
