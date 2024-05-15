import React from 'react'
import ModalWrapper from '../../../../partials/modals/ModalWrapper'
import { LiaTimesSolid } from 'react-icons/lia'
import { Formik, Form } from 'formik'
import { InputText,InputTextArea } from '../../../../helpers/FormInputs'
import SpinnerButton from '../../../../partials/spinners/SpinnerButton'
import { StoreContext } from '../../../../../store/StoreContext'
import { setError, setIsAdd, setMessage, setSuccess } from '../../../../../store/StoreAction'
import * as Yup from 'yup'
import { useMutation, useQueryClient } from '@tanstack/react-query'
import { queryData } from '../../../../helpers/queryData'

const ModalAddContact = ({itemEdit}) => {

    const{store, dispatch} = React.useContext(StoreContext);
    const handleClose = () => dispatch(setIsAdd(false));

    const queryClient = useQueryClient();
    
    const mutation = useMutation({
        mutationFn: (values) =>
        queryData(
            itemEdit ? `/v1/contact/${itemEdit.contact_aid}` :`/v1/contact` ,
            itemEdit ? "put" : "post",
            values
        ),

        onSuccess: (data) => {
        queryClient.invalidateQueries({ queryKey: ["contact"] });
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
        contact_title: itemEdit ? itemEdit.contact_title : "",
        contact_paragraph: itemEdit ? itemEdit.contact_paragraph : "",
        contact_phone: itemEdit ? itemEdit.contact_phone : "",
        contact_emailaddress: itemEdit ? itemEdit.contact_emailaddress : "",
        contact_address: itemEdit ? itemEdit.contact_address : "",
        contact_button: itemEdit ? itemEdit.contact_button : "",
        contact_name: itemEdit ? itemEdit.contact_name : "",
        contact_email: itemEdit ? itemEdit.contact_email : "",
        contact_message: itemEdit ? itemEdit.contact_message : "",
        contact_publish_date: itemEdit ? itemEdit.contact_publish_date : "",
    }

    const yupSchema = Yup.object({
        // contact_title: Yup.string().required('Required'),
        contact_paragraph: Yup.string().required('Required'),
        contact_phone: Yup.string().required('Required'),
        contact_emailaddress: Yup.string().required('Required'),
        contact_address: Yup.string().required('Required'),
        contact_button: Yup.string().required('Required'),
        contact_name: Yup.string().required('Required'),
        contact_email: Yup.string().required('Required'),
        contact_message: Yup.string().required('Required'),
        contact_publish_date: Yup.string().required('Required'),
    })

  return (
    <ModalWrapper>
    <div className="main-modal w-[300px] bg-secondary text-content h-full">
              <div className="modal-header p-4 relative">
                  <h2>New Contact</h2>
                  <button className='absolute top-[25px] right-4' onClick={handleClose}><LiaTimesSolid/></button>
              </div>
              <div className="modal-body p-4">
                  <Formik
                      initialValues={initVal}
                      validationSchema={yupSchema}
                      onSubmit={async (values) => {
                          mutation.mutate(values)
                      }}
                  >
                      {(props) => {
                          return (
                      <Form  className='flex flex-col h-[calc(100vh-110px)]'>
                      <div className='grow overflow-y-auto'>
                          
                      <div className="input-wrap">
                          <InputText
                              label="Title"
                              type="text"
                              name="contact_title"
                          />
                      </div>
                      <div className="input-wrap">
                          <InputTextArea
                              label="Description"
                              type="text"
                              name="contact_paragraph"
                              className='h-[10rem] resize-none'
                          />
                      </div>

                      <div className="input-wrap">
                      <InputText
                              label="Phone Number"
                              type="text"
                              name="contact_phone"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Email Address"
                              type="text"
                              name="contact_emailaddress"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Address"
                              type="text"
                              name="contact_address"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Button Name"
                              type="text"
                              name="contact_button"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Your Name"
                              type="text"
                              name="contact_name"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputText
                              label="Your Email"
                              type="text"
                              name="contact_email"
                          />
                      </div>
                      <div className="input-wrap">
                      <InputTextArea
                              label="Your Message"
                              type="text"
                              name="contact_message"
                              className='h-[10rem] resize-none'
                          />
                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Publish Date"
                              type="text"
                              name="contact_publish_date"
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

export default ModalAddContact