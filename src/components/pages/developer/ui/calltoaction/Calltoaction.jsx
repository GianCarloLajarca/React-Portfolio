import React from 'react'
import useQueryData from '../../../../custom-hook/useQueryData';

const Calltoaction = () => {
  const {
    data: cta,
  } = useQueryData(
   "/v1/cta", // endpoint
   "get", // method
    "cta", // key
  );

  return (
    <>
        <section className='cta bg-darkblue py-28'>
        {cta?.data.map((item, key) => (
            <div className='cta-content flex flex-col gap-12 text-center' key={key}>
                <h3 className='text-2xl text-stone-400'>{item.cta_subtitle}</h3>
                <h2 className='text-6xl text-accent font-extralight'>{item.cta_title}</h2>
            
                <button className='py-4 px-10 uppercase bg-accent text-primary font-thick w-48 mx-auto'>{item.cta_button}</button>

            </div>      
             ))}           
        </section>
    </>
  )
}

export default Calltoaction