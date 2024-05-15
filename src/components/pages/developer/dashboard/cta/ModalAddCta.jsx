import React from 'react'
import ModalWrapper from '../../../../partials/modals/ModalWrapper'
import { LiaTimesSolid } from 'react-icons/lia'
import { Formik, Form } from 'formik'
import { InputText } from '../../../../helpers/FormInputs'
import SpinnerButton from '../../../../partials/spinners/SpinnerButton'
import { StoreContext } from '../../../../../store/StoreContext'
import { setError, setIsAdd, setMessage, setSuccess } from '../../../../../store/StoreAction'
import * as Yup from 'yup'
import { useMutation, useQueryClient } from '@tanstack/react-query'
import { queryData } from '../../../../helpers/queryData'

const ModalAddCta = ({itemEdit}) => {

    const{store, dispatch} = React.useContext(StoreContext);
    const handleClose = () => dispatch(setIsAdd(false));

    const queryClient = useQueryClient();
    
    const mutation = useMutation({
        mutationFn: (values) =>
        queryData(
            itemEdit ? `/v1/cta/${itemEdit.cta_aid}` :`/v1/cta` ,
            itemEdit ? "put" : "post",
            values
        ),

        onSuccess: (data) => {
        queryClient.invalidateQueries({ queryKey: ["cta"] });
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
        cta_title: itemEdit ? itemEdit.cta_title : "",
        cta_subtitle: itemEdit ? itemEdit.cta_subtitle : "",
        cta_button: itemEdit ? itemEdit.cta_button : "",
        cta_publish_date: itemEdit ? itemEdit.cta_publish_date : "",
    }

    const yupSchema = Yup.object({
        cta_title: Yup.string().required('Required'),
        cta_subtitle: Yup.string().required('Required'),
        cta_button: Yup.string().required('Required'),
        cta_publish_date: Yup.string().required('Required'),
    })

  return (
    <ModalWrapper>
    <div className="main-modal w-[300px] bg-secondary text-content h-full">
              <div className="modal-header p-4 relative">
                  <h2>New Call To Action Content</h2>
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
                              name="cta_title"
                          />
                      </div>
                      <div className="input-wrap">
                          <InputText
                              label="Subtitle"
                              type="text"
                              name="cta_subtitle"
                          />
                      </div>

                      <div className="input-wrap">
                      <InputText
                              label="Button Name"
                              type="text"
                              name="cta_button"
                          />
                      </div>

                      <div className="input-wrap">
                          <InputText
                              label="Publish Date"
                              type="text"
                              name="cta_publish_date"
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

export default ModalAddCta