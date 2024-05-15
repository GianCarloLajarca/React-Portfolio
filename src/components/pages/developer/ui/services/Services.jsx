import React from 'react'
import { FaCode } from 'react-icons/fa'
import { IoDiamondSharp } from 'react-icons/io5'
import { MdOutlineDevices } from 'react-icons/md'
import useQueryData from '../../../../custom-hook/useQueryData'
import { devBaseImgUrl } from '../../../../helpers/functions-general'

const Services = () => {
        const {
                isLoading,
                isFetching,
                error,
                data: service,
              } = useQueryData(
               "/v1/service", // endpoint
               "get", // method
                "service", // key
              );

  return (
    <>
        <section className='service-area bg-primary pt-[115px] px-[0] pb-[120px] block box-border text-[16px] text-[#818181] font-[400] leading-[1.5] text-left grid place-content-center'>
        <div className="container w-full px-[15px] box-border ">

            <div className='flex flex-wrap mx-[-15px] box-border'>
                <div className='text-center relative w-full min-h-[1px] px-[15px] box-border'>
                    <div className='section-title text-center mb-[57px] '>
                        <span className='subtitle text-[16px] font-semibold text-[#d1d1d1] leading-[26px] block box-border text-center'>Service</span>
                        <h2 className='mb-[16px] text-[32px] leading-[38px] font-bold text-accent'>What I do</h2>
                        <p className='text-[16px] text-[#d0d0d0] max-w-[720px] mx-[auto] my-[0] leading-[1.625] text-center'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi commodo orci odio, ut bus sed. Phasellus vitae ullamcorper
                        purus. Curabitur vel vestibulum justo.</p>

                    </div>
                </div>

            </div>

            <div className='flex flex-row flex-wrap gap-8'>
            {service?.data.map((item, key) => (
                
                <div className='row flex flex-wrap mr-[15px] ml-[15px] box-border basis[49%]' key={key}>
                                <div className='service-card relative w-full min-h-[1px] pr-[15px] pl-[15px] w-72'>
                                        <div className='single-service-box text-center border-[1px] border-[solid] border-[rgba(255,255,255,0.3)] rounded-[5px] 
                                        w-72 h-56 px-[30px] py-[30px]
                                        [transition:all_0.3s_ease-in] relative z-0 hover:bg-accent hover:text-darkblue transition-all hover:bg-opacity-70'>
                                            <div className="icon text-[52px] leading-[62px] text-[#fff] mb-[18px] box-border visible text-center">
                                                        <img src={`${devBaseImgUrl}/${item.service_photo}`} alt="" className='w-[6rem] h-[6rem] mx-auto object-contain'/>
                                            </div>

                                            <div className="service-card-content box-border visible text-center text-[16px] text-[#818181] font-[400] leading-[1.5]">
                                                    <h4 className='text-[20px] font-semibold text-[#fff] leading-[1.2380952380952381] mb-[.5rem] mt-0 text-center hover:text-darkblue'>{item.service_title}</h4>
                                            </div>
                                        </div>
                                </div>
                </div>

        ))}   
        </div>
    </div>

        </section>
    </>
  )
}

export default Services