import React from 'react';
import Slider from "react-slick";
import { baseImgUrl, devBaseImgUrl } from '../../../../helpers/functions-general';
import useQueryData from '../../../../custom-hook/useQueryData';

const SliderSkills = () => {

    const {
        isLoading,
        isFetching,
        error,
        data: skill,
      } = useQueryData(
       "/v1/skill", // endpoint
       "get", // method
        "skill", // key
      );

    var settings = {
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
      };
      
  return (
    <>
        <div className='slider-skills py-20'>
         <div className='slider-skills-title flex flex-col gap-4 mb-20 max-w-[45rem] mx-auto leading-8'>
                <h2 className='text-accent text-4xl text-center'>Skills</h2>
                <p className='text-md text-stone-300 text-center'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta nam exercitationem at aspernatur eligendi labore corrupti.</p>
        </div>
            <Slider {...settings} className='px-20 cursor-pointer'>
            {skill?.data.map((item, key) => (
                <div className='skills-card p-5 text-center bg-darkblue shadow-md h-[400px]' key={key}>
                    <div className='flex flex-col gap-4 p-12'>
                    <img src={`${devBaseImgUrl}/${item.skill_photo}`} alt="" className='w-[7rem] h-[6rem] mx-auto object-contain'/>
                        <h3>{item.skill_title}</h3>
                        <p>{item.skill_description}</p>
                    </div>   
                </div>
            ))} 
            </Slider>
        </div>
    </>
  );
}

export default SliderSkills