import React from 'react'
import { baseImgUrl } from '../../../../helpers/functions-general'
import { FaTimesCircle } from 'react-icons/fa'
import useQueryData from '../../../../custom-hook/useQueryData';
import { StoreContext } from '../../../../../store/StoreContext';
import { setIsShow } from '../../../../../store/StoreAction';

const ModalProject = ({info}) => {
  const {dispatch} = React.useContext(StoreContext)
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


  const handleClose = () => dispatch(setIsShow(false));
  return (
    <div className='fixed top-0 left-0 isolate w-full h-screen'>
        <div className="backdrop absolute top-0 left-0 h-full w-full bg-black/80 "></div>
        <main className='max-w-[700px] w-full bg-primary text-white absolute left-1/2 top-1/2 -translate-x-1/2 
        -translate-y-1/2 inset-0 z-[9999] max-h-[900px] h-full p-10'>
          <h2 className='text-center pt-3 text-3xl'> {info.project_title} Project Interface</h2>
            <button onClick={handleClose} type="button" className='absolute top-4 right-4 text-[#141414] text-xl hover:text-accent transition-all'><FaTimesCircle /></button>
              <div className='project grid grid grid-cols-2 gap-5 py-32'>
                
                        <a href={info.project_image_1} data-lightbox="image-1" data-title="WonderTour Homepage"><img src={info.project_image_1} alt="" className='object-cover'/></a>
                        <a href={info.project_image_2} data-lightbox="image-1" data-title="About Page"><img src={info.project_image_2} alt="" className=' object-cover'/></a>
                        <a href={info.project_image_3} data-lightbox="image-1" data-title="About Page - Destinations Section"><img src={info.project_image_3} alt="" className=' object-cover'/></a>
                        <a href={info.project_image_4} data-lightbox="image-1" data-title="Our Tours Page"><img src={info.project_image_4} alt="" className=' object-cover'/></a>
                        <a href={info.project_image_5} data-lightbox="image-1" data-title="About Page - What people Say Section"><img src={info.project_image_5} alt="" className=' object-cover'/></a>
                        <a href={info.project_image_6} data-lightbox="image-1" data-title="About Page - Parallax and Footer Section"><img src={info.project_image_6} alt="" className=' object-cover'/></a>
              </div>
            
        </main>
    </div>
  )
}

export default ModalProject