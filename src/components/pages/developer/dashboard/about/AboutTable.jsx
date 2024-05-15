import React from 'react'
import { StoreContext } from '../../../../../store/StoreContext';
import { setIsActive, setIsAdd, setIsDelete } from '../../../../../store/StoreAction';
import SpinnerFetching from '../../../../partials/spinners/SpinnerFetching';
import TableLoader from '../../../../partials/TableLoader';
import NoData from '../../../../partials/NoData';
import { LiaEdit, LiaHistorySolid, LiaTrashAltSolid } from 'react-icons/lia';
import { PiArchive } from 'react-icons/pi';
import ModalConfirm from '../../../../partials/modals/ModalConfirm';
import ModalDelete from '../../../../partials/modals/ModalDelete';

const AboutTable = ({isLoading, isFetching, about, setItemEdit}) => {
    const {store, dispatch} = React.useContext(StoreContext)
    const [isArchiving, setIsArchiving] = React.useState(0);
    const [id, setId] = React.useState('')

    let counter = 1

    const handleArchive = (item) => {
        dispatch(setIsActive(true));
        setId(item.about_aid)
        setIsArchiving(0)
    }
    const handleRestore = (item) => {
        dispatch(setIsActive(true));
        setId(item.about_aid)
        setIsArchiving(1)
    }

    const handleDelete = (item) => {
        dispatch(setIsDelete(true))
        setId(item.about_aid)
    }

    const handleEdit = (item) => {
        dispatch(setIsAdd(true))
        setItemEdit(item)
    }

  return (
    <>
    <div>

    <div className="table-wrapper relative">
        {isFetching && <SpinnerFetching/>}
            <table>
                <thead>
                    <tr>
                        <th className='w-[20px]'>#</th>
                        <th className='w-[150px]'>Name</th>
                        <th className='w-[80px]'>Email</th>
                        <th className='w-[80px]'>Phone</th>
                        <th className='w-[80px]'>Birthday</th>
                        <th className='w-[80px]'>Nationality</th>
                        <th className='w-[80px]'>Address</th>
                        <th className='w-[80px]'>Published</th>
                        <th className='w-[100px]'>Action</th>
                    </tr>
                </thead>
                <tbody>

                {isLoading && ( 
        <tr>
            <td colSpan={9}>
                <TableLoader count="20" cols="4"/>
            </td>
        </tr>)
        }

        {about?.data.length === 0 && (
            <tr>
                <td colSpan={9}>
                    <NoData/>
                </td>
            </tr>
        )}

            {about?.data.map((item, key)=>(
                <tr key={key}>
                <td>{counter++}</td>
                <td>{item.about_name}</td>
                <td>{item.about_email}</td>
                <td>{item.about_phone}</td>
                <td>{item.about_birthday}</td>
                <td>{item.about_nationality}</td>
                <td>{item.about_address}</td>
                <td>{item.about_publish_date}</td>
                <td className='table-action'>
                    <ul>
                        {item.about_is_active ? (
                            <>
                                <li><button className="tooltip" data-tooltip="Edit" onClick={()=>handleEdit(item)}><LiaEdit/></button></li>
                                <li><button onClick={()=>handleArchive(item)} className="tooltip" data-tooltip="Archive" ><PiArchive /></button></li>
                            </>
                        ) : (
                            <>
                            <li><button className="tooltip" data-tooltip="Restore" onClick={()=>handleRestore(item)}><LiaHistorySolid/></button></li>
                            <li><button className="tooltip" data-tooltip="Delete" onClick={()=>handleDelete(item)} ><LiaTrashAltSolid/></button></li></>
                        )}
                    </ul>
                </td>
            </tr>  
            ))}
                    
            </tbody>
        </table>
    </div>
    </div>

    {store.isActive && <ModalConfirm position="center" queryKey="about" endpoint={`/v1/about/active/${id}`} 
        isArchiving={isArchiving}/>}

    {store.isDelete && <ModalDelete position="center" endpoint={`/v1/about/${id}`} 
    queryKey="about"/>}

    {/* {isSuccess && <Toast setIsSuccess={setIsSuccess} message={message}/>} */}
    </>
  )
}

export default AboutTable