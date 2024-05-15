import React from 'react'
import CertificationsHonors from './CertificationsHonors';
import CertificationsTopPerforming from './CertificationsTopPerforming';
import CertificationsFoundation from './CertificationsFoundation';

const Certifications = () => {

    const [certTab, setCertTab] = React.useState('honors');

    const handleChangeCert = (cert) => {
        setCertTab(cert)
    }
  return (
    <>
        <section className='awards-certifications py-12 bg-darkblue px-40'>
          <div className='flex flex-col gap-5 text-center'>
                <div>
                      <h2 className='text-accent text-3xl'>Awards & Certifications</h2>
                </div>

                <div>
                      <p>My awards and certifications during my college years.</p>
                </div>
          </div>
            
          <div className='tab flex justify-between items-center mt-8  mb-8 w-[30rem] max-w-[26rem] mx-auto'>
            <ul className='flex gap-12'>
                  <li className='font-bold'><button className={`${certTab==="honors" ? "text-accent border-b border-accent" : "hover:text-accent transition-all"}`} onClick={() => handleChangeCert("honors")}>Honors</button></li>
                  <li className='font-bold whitespace-nowrap'><button className={`${certTab==="topstudent" ? "text-accent border-b border-accent" : "hover:text-accent transition-all"}`} onClick={() => handleChangeCert("topstudent")}>Top Performing Student</button></li>
                  <li className='font-bold'><button className={`${certTab==="certifications" ? "text-accent border-b border-accent" : "hover:text-accent transition-all"}`} onClick={() => handleChangeCert("certifications")}>Certifications</button></li>
            </ul>

          </div>

          {certTab === "honors" && <CertificationsHonors/>}
          {certTab === "topstudent" && <CertificationsTopPerforming />}
          {certTab === "certifications" && <CertificationsFoundation />}

    </section>
    </>
  )
}

export default Certifications