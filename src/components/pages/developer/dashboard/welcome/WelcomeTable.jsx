import React from 'react'
import { FaLongArrowAltRight } from 'react-icons/fa';
import { Link } from 'react-router-dom';

const WelcomeTable = ({certificate, honor, project, skill, top}) => {

  return (
    <>
                            <div className='grid grid-cols-4 gap-4 place-content-center'>
                                

                                <div className='item-cards bg-darkblue p-12'>
                                    <h3>No. of Foundation Certificate Info</h3>
                                    <h4 className='text-3xl'>{certificate?.data.length}</h4>
                                    <Link to="/certificate" className='hover:text-accent'> <span>View Details<FaLongArrowAltRight /></span></Link>
                                </div>
                               
                                <div className='item-cards bg-darkblue p-12'>
                                    <h3>No. of Honor Certifications Info</h3>
                                    <h4 className='text-3xl'>{honor?.data.length}</h4>
                                    <Link to="/honor" className='hover:text-accent'><span>View Details<FaLongArrowAltRight /></span></Link>
                                </div>
                                <div className='item-cards bg-darkblue p-12'>
                                    <h3>No. of Projects Info</h3>
                                    <h4 className='text-3xl'>{project?.data.length}</h4>
                                    <Link to="/project" className='hover:text-accent'><span>View Details<FaLongArrowAltRight /></span></Link>
                                </div>
                
                                <div className='item-cards bg-darkblue p-12'>
                                    <h3>No. of Skills Info</h3>
                                    <h4 className='text-3xl'>{skill?.data.length}</h4>
                                    <Link to="/skill" className='hover:text-accent'><span>View Details<FaLongArrowAltRight /></span></Link>
                                </div>
                                <div className='item-cards bg-darkblue p-12'>
                                    <h3>No. of Top Student Certifications Info</h3>
                                    <h4 className='text-3xl'>{top?.data.length}</h4>
                                    <Link to="/top" className='hover:text-accent'><span>View Details<FaLongArrowAltRight /></span></Link>
                                </div>
                            </div>
    </>
  )
}

export default WelcomeTable
