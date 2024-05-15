import React from 'react';
import useQueryData from '../../../../custom-hook/useQueryData';
import { devBaseImgUrl } from '../../../../helpers/functions-general';

const CertificationsTopPerforming = () => {

    const {
        isLoading,
        isFetching,
        error,
        data: top,
      } = useQueryData(
       "/v1/top", // endpoint
       "get", // method
        "top", // key
      );

  return (
    <div className='honors-grid grid grid-cols-3 gap-7 py-20 bg-darkblue'>
        {top?.data.map((item, key) => (
        <div className='honor-card pb-44 pt-5 px-10' key={key}>
            <div className='honor-image bg-primary'>
                <a href={`${devBaseImgUrl}/${item.top_photo}`} data-lightbox="image-1" data-title={item.top_title}><img src={`${devBaseImgUrl}/${item.top_photo}`} alt="" className=' object-cover'/></a>
            </div>
            <div className='honor-details flex flex-col gap-5 mt-5'>
                <div className='honor-title'>
                    <h3 className='text-accent text-xl'>{item.top_title}</h3>
                </div>
                   <div className='honor-date'>
                    <h4 className='text-stone-400'>{item.top_date}</h4>
                  </div>  

                <div className='honor-school'>
                    <h3 className='text-stone-400'>{item.top_giver}</h3>
                </div>      

            </div>    
        </div>
         ))} 
    </div>
  )
}

export default CertificationsTopPerforming