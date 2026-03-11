import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { CalendarDate } from '@internationalized/date'

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function dateToCalendarDate(date: string): CalendarDate {
    const dateObject = new Date(date)

    return new CalendarDate(
        dateObject.getFullYear(),
        dateObject.getMonth() + 1,
        dateObject.getDate()
    )
}

export function getFormOptions() {
    return {
        preserveScroll: true,
        preserveState: true,
        preserveUrl: true,
        replace: true,
        only: ['users', 'flash'],
        except: ['secret'],
        reset: ['page'],
    }
}
