'use client';
import { FormEvent } from 'react'
 
export default function Page() {
  async function onSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault()
 
    const formData = new FormData(event.currentTarget)

    const response = await fetch(process.env.NEXT_PUBLIC_PLATYPLUS2_API + '/index.php/login_', {
      method: 'POST',
      body: formData,
    })
 
    // Handle response if necessary
    const data = await response.json()
    // ...
  }
 
  return (
    <form onSubmit={onSubmit} className='text-white'>
      <p>
        <label>
            Email <input type="text" name="email" className='text-black' />
        </label>
      </p>
      <p>
        <label>
            Password <input type="text" name="password" className='text-black'/>
        </label>
      </p>
      <button type="submit">Submit</button>
    </form>
  )
}