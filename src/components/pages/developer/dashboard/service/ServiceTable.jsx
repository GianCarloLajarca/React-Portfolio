import React from 'react'
import { setIsActive, setIsAdd, setIsDelete } from '../../../../../store/StoreAction';
import { StoreContext } from '../../../../../store/StoreContext';
import ModalConfirm from '../../../../partials/modals/ModalConfirm';
import ModalDelete from '../../../../partials/modals/ModalDelete';
import SpinnerFetching from '../../../../partials/spinners/SpinnerFetching';
import TableLoader from '../../../../partials/TableLoader';
import NoData from '../../../../partials/NoData';
import { LiaEdit, LiaHistorySolid, LiaTrashAltSolid } from 'react-icons/lia';
import { PiArchive } from 'react-icons/pi';

const ServiceTable = ({isLoading, isFetching, service, setItemEdit}) => {

  const {store, dispatch} = React.useContext(StoreContext)
    const [isArchiving, setIsArchiving] = React.useState(0);
    const [id, setId] = React.useState('')

    let counter = 1

    const handleArchive = (item) => {
        dispatch(setIsActive(true));
        setId(item.service_aid)
        setIsArchiving(0)
    }
    const handleRestore = (item) => {
        dispatch(setIsActive(true));
        setId(item.service_aid)
        setIsArchiving(1)
    }

    const handleDelete = (item) => {
        dispatch(setIsDelete(true))
        setId(item.service_aid)
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
                        <th className='w-[150px]'>Title</th>
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

        {service?.data.length === 0 && (
            <tr>
                <td colSpan={9}>
                    <NoData/>
                </td>
            </tr>
        )}

            {service?.data.map((item, key)=>(
                <tr key={key}>
                <td>{counter++}</td>
                <td>{item.service_title}</td>
                <td>{item.service_publish_date}</td>
                <td className='table-action'>
                    <ul>
                        {item.service_is_active ? (
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

    {store.isActive && <ModalConfirm position="center" queryKey="service" endpoint={`/v1/service/active/${id}`} 
        isArchiving={isArchiving}/>}

    {store.isDelete && <ModalDelete position="center" endpoint={`/v1/service/${id}`} 
    queryKey="service"/>}

    {/* {isSuccess && <Toast setIsSuccess={setIsSuccess} message={message}/>} */}
    </>
  )
}

export default ServiceTable