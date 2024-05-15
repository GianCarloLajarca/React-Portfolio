import React from 'react';
import { BsFillHddNetworkFill } from 'react-icons/bs';
import { FaDatabase, FaLaptopCode } from 'react-icons/fa';
import { GrReactjs } from 'react-icons/gr';
import { MdOutlineSecurity } from 'react-icons/md';
import Slider from "react-slick";
import { baseImgUrl } from '../../../../helpers/functions-general';
import useQueryData from '../../../../custom-hook/useQueryData';
import { StoreContext } from '../../../../../store/StoreContext';
import ModalProject from './ModalProject';
import { setIsShow } from '../../../../../store/StoreAction';

const SliderProjects = ({setProjectInterface}) => {

    const {store, dispatch} = React.useContext(StoreContext)
    const [info, setInfo] = React.useState(null)

    // const handleShowProjectInterface = () => {
    //     setProjectInterface(true)
    // }

    const {
        isLoading,
        isFetching,
        error,
        data: project,
      } = useQueryData(
       "/v1/project", // endpoint
       "get", // method
        "project", // key
      );


    var settings = {
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
      };

      const handleShowMore = (item) => {
        dispatch(setIsShow(true));
        setInfo(item)
  }
      
  return (
    <>
        <div className='slider-projects py-20'>
         <div className='slider-projects-title flex flex-col gap-4 mb-20 max-w-[45rem] mx-auto leading-8'>
                <h2 className='text-accent text-4xl text-center'>Projects</h2>
                <p className='text-md text-stone-300 text-center'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta nam exercitationem at aspernatur eligendi labore corrupti.</p>
        </div>
            <Slider {...settings} className='px-20 cursor-pointer'>
            {project?.data.map((item, key) => (
                    <div className='projects-card p-5 text-center bg-darkblue shadow-md h-[700px] hover:bg-accent  hover:bg-opacity-40 transition-all' key={key}>
                    <div className='flex flex-col gap-10 p-12'>
                        <img src={item.project_thumbnail} alt="" className='w-full h-[14rem] mx-auto object-contain'/>
                        <h3>{item.project_title}</h3>
                        <ul className='flex justify-between opacity-55 mb-2'>
                             <li><small>{item.project_category}</small></li>
                              <li><small>{item.project_publish_date}</small></li>
                        </ul>
                        <p>{item.project_description}</p>
                        <button className='bg-accent rounded-md w-full justify-center py-3 text-primary font-thick hover:bg-primary hover:text-white transition-all' onClick={() => handleShowMore(item)}>{item.project_button}</button>
                    </div>   
                    </div>
            ))} 
            </Slider>
        </div>

        {store.isShow && <ModalProject info={info}/>}
    </>
  );
}

export default SliderProjects