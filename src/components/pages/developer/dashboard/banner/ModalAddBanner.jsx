import React from 'react'
import ModalWrapper from '../../../../partials/modals/ModalWrapper'
import { LiaTimesSolid } from 'react-icons/lia'
import { Formik, Form } from 'formik'
import { InputFileUpload, InputText,InputTextArea } from '../../../../helpers/FormInputs'
import SpinnerButton from '../../../../partials/spinners/SpinnerButton'
import { StoreContext } from '../../../../../store/StoreContext'
import { setError, setIsAdd, setMessage, setSuccess } from '../../../../../store/StoreAction'
import * as Yup from 'yup'
import { useMutation, useQueryClient } from '@tanstack/react-query'
import { queryData } from '../../../../helpers/queryData'
import useUploadPhoto from '../../../../custom-hook/useUploadPhoto'
import { devBaseImgUrl } from '../../../../helpers/functions-general'

const ModalAddBanner = ({itemEdit}) => {

    const{store, dispatch} = React.useContext(StoreContext);
    const handleClose = () => dispatch(setIsAdd(false));

    const { uploadPhoto, handleChangePhoto, photo } = useUploadPhoto(
        `/v1/upload/photo`,
        dispatch
      );

    const queryClient = useQueryClient();
    
    const mutation = useMutation({
        mutationFn: (values) =>
        queryData(
            itemEdit ? `/v1/banner/${itemEdit.banner_aid}` :`/v1/banner` ,
            itemEdit ? "put" : "post",
            values
        ),

        onSuccess: (data) => {
        queryClient.invalidateQueries({ queryKey: ["banner"] });
        if (data.success) {
            dispatch(setIsAdd(false));
            dispatch(setSuccess(true));
            dispatch(setMessage(`Successfuly updated.`));
        }else{
            dispatch(setError(true))
            dispatch(setMessage(data.error))
        }
        },
    });

    const initVal = {
        banner_greet: itemEdit ? itemEdit.banner_greet : "",
        banner_photo: itemEdit ? itemEdit.banner_photo : "",
        banner_firstname: itemEdit ? itemEdit.banner_firstname : "",
        banner_lastname: itemEdit ? itemEdit.banner_lastname : "",
        banner_name: itemEdit ? itemEdit.banner_name : "",
        banner_description: itemEdit ? itemEdit.banner_description : "",
        banner_button: itemEdit ? itemEdit.banner_button : "",
        banner_scroll: itemEdit ? itemEdit.banner_scroll : "",
        banner_publish_date: itemEdit ? itemEdit.banner_publish_date : "",
    }

    const yupSchema = Yup.object({
        banner_greet: Yup.string().required('Required'),
        // banner_photo: Yup.string().required('Required'),
        banner_firstname: Yup.string().required('Required'),
        banner_lastname: Yup.string().required('Required'),
        banner_name: Yup.string().required('Required'),
        banner_description: Yup.string().required('Required'),
        banner_button: Yup.string().required('Required'),
        banner_scroll: Yup.string().required('Required'),
        banner_publish_date: Yup.string().required('Required'),
    })

  return (
    <ModalWrapper>
    <div className="main-modal w-[300px] bg-secondary text-content h-full">
              <div className="modal-header p-4 relative">
                  <h2>New Banner</h2>
                  <button className='absolute top-[25px] right-4' onClick={handleClose}><LiaTimesSolid/></button>
              </div>
              <div className="modal-body p-4">
                  <Formik
                      initialValues={initVal}
                      validationSchema={yupSchema}
                      onSubmit={async (values) => {
                        uploadPhoto()
                        mutation.mutate({...values, 
                            banner_photo:
                            (itemEdit && itemEdit.banner_photo === "") || photo
                              ? photo === null
                                ? itemEdit.banner_photo
                                : photo.name
                              : values.banner_photo,})
                      }}
                  >
                      {(props) => {
                          return (
                      <Form  className='flex flex-col h-[calc(100vh-110px)]'>
                      <div className='grow overflow-y-auto'>
                      
                      <div className="input-wrap">

                            {photo || (itemEdit && itemEdit.banner_photo !== "") ? (
                        <img
                          src={
                            photo
                              ? URL.createObjectURL(photo) // preview
                              : itemEdit.banner_photo // check db
                              ? devBaseImgUrl + "/" + itemEdit.banner_photo
                              : null
                          }
                          alt="Photo"
                          className="rounded-tr-md rounded-tl-md h-[200px] max-h-[200px] w-full object-cover object-center m-auto"
                        />
                      ) : (
                        <span className="min-h-20 flex items-center justify-center">
                          <span className="text-accent mr-1">Drag & Drop</span>{" "}
                          photo here or{" "}
                          <span className="text-accent ml-1">Browse</span>
                        </span>
                      )}

                      {(photo !== null ||
                        (itemEdit && itemEdit.banner_photo !== "")) && (
                        <span className="min-h-10 flex items-center justify-center">
                          <span className="text-accent mr-1">Drag & Drop</span>{" "}
                          photo here or{" "}
                          <span className="text-accent ml-1">Browse</span>
                        </span>
                      )}

                      {/* <FaUpload className="opacity-100 duration-200 group-hover:opacity-100 fill-dark/70 absolute top-0 right-0 bottom-0 left-0 min-w-[1.2rem] min-h-[1.2rem] max-w-[1.2rem] max-h-[1.2rem] m-auto cursor-pointer" /> */}
                      <InputFileUpload
                        label="Photo"
                        name="photo"
                        type="file"
                        id="myFile"
                        accept="image/*"
                        title="Upload photo"
                        onChange={(e) => handleChangePhoto(e)}
                        onDrop={(e) => handleChangePhoto(e)}
                        className="opacity-0 absolute right-0 bottom-0 left-0 m-auto cursor-pointer h-full "
                      />
                  


                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Greetings"
                              type="text"
                              name="banner_greet"
                          />
                      </div>

                    
                      <div className="input-wrap">
                      <InputText
                              label="First Name"
                              type="text"
                              name="banner_firstname"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Last Name"
                              type="text"
                              name="banner_lastname"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Full Name"
                              type="text"
                              name="banner_name"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputTextArea
                              label="Description"
                              type="text"
                              name="banner_description"
                              className='h-[10rem] resize-none'
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Button Name"
                              type="text"
                              name="banner_button"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Scroll Name"
                              type="text"
                              name="banner_scroll"
                          />
                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Publish Date"
                              type="text"
                              name="banner_publish_date"
                          />
                      </div>
        
                      </div>

                      <div className='form-action'>
                          <button className='btn btn-form btn--accent' type="submit"> {mutation.isPending ? <SpinnerButton/> : "Add" }</button>
                          <button className='btn btn-form btn--cancel' type="button" onClick={handleClose}>Cancel</button>
                      </div>
                  </Form>)}}
                  
                  </Formik>
              </div>
      </div>
    </ModalWrapper>
  )
}

export default ModalAddBanner