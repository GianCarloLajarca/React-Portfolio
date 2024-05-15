import React from 'react'
import { baseImgUrl } from '../../../../helpers/functions-general'

const Header = () => {
  return (
    <>
        <header className='flex py-10 px-2 justify-around'>
            <div className='header-logo w-24 h-11 object-cover'>
                <img src={`${baseImgUrl}/home/logo.png`} alt="" />
            </div>
            <div className='header-nav text-stone-500'>
                <ul className='flex gap-16'>
                    <li><a href="#banner" className='hover:text-accent transition-all'>Home</a></li>
                    <li><a href="#skills" className='hover:text-accent transition-all'>Skills</a></li>
                    <li><a href="#project" className='hover:text-accent transition-all'>Project</a></li>
                    <li><a href="#contact" className='hover:text-accent transition-all '>Contact</a></li>
                </ul>
            </div>
            <div className='header-language'>
                <ul className='flex gap-4 text-stone-500 font-bold'>
                    <li className='hover:text-accent transition-all cursor-pointer'>FRA</li>
                    <li className='hover:text-accent transition-all cursor-pointer'>FER</li>
                    <li className='text-accent cursor-pointer'>ENG</li>
                </ul>
            </div>
        </header> 
    </>
  )
}

export default Header