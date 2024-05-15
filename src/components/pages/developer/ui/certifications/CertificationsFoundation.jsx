import React from 'react'
import { baseImgUrl, devBaseImgUrl } from '../../../../helpers/functions-general'
import useQueryData from '../../../../custom-hook/useQueryData';

const CertificationsFoundation = () => {

    const {
        isLoading,
        isFetching,
        error,
        data: certificate,
      } = useQueryData(
       "/v1/certificate", // endpoint
       "get", // method
        "certificate", // key
      );

  return (
    <div className='certs-grid grid grid-cols-3 gap-7 py-20 bg-darkblue'>
        {certificate?.data.map((item, key) => (
        <div className='cert-card pb-44 pt-5 px-10' key={key}>
            <div className='cert-image bg-primary'>
                {/* <img src={`${baseImgUrl}/home/cert-1.jpg`} alt="" className=' object-cover'/> */}
                <a href={`${devBaseImgUrl}/${item.certificate_photo}`} data-lightbox="image-1" data-title={item.certificate_title}><img src={`${devBaseImgUrl}/${item.certificate_photo}`} alt="" className=' object-cover'/></a>
                
            </div>
            <div className='cert-details flex flex-col gap-5 mt-5'>
                <div className='cert-title'>
                    <h3 className='text-accent text-xl'>{item.certificate_title}</h3>
                </div>
                   <div className='cert-date'>
                    <h4 className='text-stone-400'>{item.certificate_date}</h4>
                  </div>  

                <div className='cert-school'>
                    <h3 className='text-stone-400'>{item.certificate_organization}</h3>
                </div>      

            </div>    
        </div>
        ))}  
    </div>
  )
}

export default CertificationsFoundation