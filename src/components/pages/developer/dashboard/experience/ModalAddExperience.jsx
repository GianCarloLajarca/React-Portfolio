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

const ModalAddExperience = ({itemEdit}) => {

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
            itemEdit ? `/v1/experience/${itemEdit.experience_aid}` :`/v1/experience` ,
            itemEdit ? "put" : "post",
            values
        ),

        onSuccess: (data) => {
        queryClient.invalidateQueries({ queryKey: ["experience"] });
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
        experience_title: itemEdit ? itemEdit.experience_title : "",
        experience_photo: itemEdit ? itemEdit.experience_photo : "",
        experience_description: itemEdit ? itemEdit.experience_description : "",
        experience_date: itemEdit ? itemEdit.experience_date : "",
        experience_job: itemEdit ? itemEdit.experience_job : "",
        experience_publish_date: itemEdit ? itemEdit.experience_publish_date : "",
    }

    const yupSchema = Yup.object({
        experience_title: Yup.string().required('Required'),
        // experience_photo: Yup.string().required('Required'),
        experience_description: Yup.string().required('Required'),
        experience_date: Yup.string().required('Required'),
        experience_job: Yup.string().required('Required'),
        experience_publish_date: Yup.string().required('Required'),
    })

  return (
    <ModalWrapper>
    <div className="main-modal w-[300px] bg-secondary text-content h-full">
              <div className="modal-header p-4 relative">
                  <h2>New Experience</h2>
                  <button className='absolute top-[25px] right-4' onClick={handleClose}><LiaTimesSolid/></button>
              </div>
              <div className="modal-body p-4">
                  <Formik
                      initialValues={initVal}
                      validationSchema={yupSchema}
                      onSubmit={async (values) => {
                        uploadPhoto()
                        mutation.mutate({...values, 
                            experience_photo:
                            (itemEdit && itemEdit.experience_photo === "") || photo
                              ? photo === null
                                ? itemEdit.experience_photo
                                : photo.name
                              : values.experience_photo,})
                      }}
                  >
                      {(props) => {
                          return (
                      <Form  className='flex flex-col h-[calc(100vh-110px)]'>
                      <div className='grow overflow-y-auto'>
                       
                      <div className="input-wrap">

                            {photo || (itemEdit && itemEdit.experience_photo !== "") ? (
                            <img
                            src={
                            photo
                            ? URL.createObjectURL(photo) // preview
                            : itemEdit.experience_photo // check db
                            ? devBaseImgUrl + "/" + itemEdit.experience_photo
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
                            (itemEdit && itemEdit.experience_photo !== "")) && (
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
                              label="Title"
                              type="text"
                              name="experience_title"
                          />
                      </div>

                      <div className="input-wrap">
                      <InputTextArea
                              label="Description"
                              type="text"
                              name="experience_description"
                              className='h-[10rem] resize-none'
                          />
                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Experience Date"
                              type="text"
                              name="experience_date"
                          />
                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Experience Job"
                              type="text"
                              name="experience_job"
                          />
                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Publish Date"
                              type="text"
                              name="experience_publish_date"
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

export default ModalAddExperience