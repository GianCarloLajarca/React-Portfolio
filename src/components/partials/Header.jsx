import React from 'react'
import { CiBellOn } from 'react-icons/ci'
import { LiaAngleDownSolid, LiaKeySolid, LiaSignOutAltSolid, LiaUserCircle } from 'react-icons/lia'
import { Link } from 'react-router-dom'
import { baseImgUrl } from '../helpers/functions-general'

const Header = () => {

    const handleChangeColorTheme = (color) => {
        if(localStorage.getItem("theme") === "white") {
            localStorage.setItem("theme", "dark") 
        } else {
            localStorage.setItem("theme", "white")
        }

        document.querySelector("body").setAttribute('class', "");
        document.querySelector("body").setAttribute('class', localStorage.getItem("theme"));
        }

  return (
    <header className='header px-4 py-3 border-b border-line'>
        <div className='flex justify-end items-center gap-4 w-full relative'>
            <button className='text-3xl' onClick={() => handleChangeColorTheme('dark')}><CiBellOn/></button>
            <img src={`${baseImgUrl}/home/profile.jpg`} alt="" className='size-[40px] rounded-full object-cover'/>
            <div>
                <button className='flex items-center gap-5'>Gian Carlo Lajarca <LiaAngleDownSolid /></button>
                <div className='hidden header-dropdown absolute bg-secondary p-4 rounded-md right-0 top-[calc(100%+10px)] text-center shadow-xs'>
                    <img src="https://via.placeholder.com/40x40" alt="" className='size-[40px] rounded-full object-cover mx-auto'/>
                    <h4 className='mb-1'>Gian Carlo Lajarca</h4>
                    <p className='text-sm w-[150px] truncate'>gianlajarca14@gmail.com</p>
                    <ul className='flex justify-center gap-5'>
                        <li><Link to="#" className='text-2xl'><LiaUserCircle/></Link></li>
                        <li><Link to="#" className='text-2xl'><LiaKeySolid/></Link></li>
                        <li><Link to="#" className='text-2xl'><LiaSignOutAltSolid/></Link></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
  )
}

export default Header