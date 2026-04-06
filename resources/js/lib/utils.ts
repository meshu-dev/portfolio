import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { CalendarDate } from '@internationalized/date'
import dayjs from 'dayjs'
import advancedFormat from 'dayjs/plugin/advancedFormat'
import weekOfYear from 'dayjs/plugin/weekOfYear'
import utc from 'dayjs/plugin/utc'
import timezone from 'dayjs/plugin/timezone'
import customParseFormat from 'dayjs/plugin/customParseFormat'
import { NavLink, NavLinkMenu } from '@/types/portfolio';

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

export function getFormattedDate(date: string, format: string): string {
  dayjs.extend(advancedFormat)
  dayjs.extend(weekOfYear)
  dayjs.extend(utc)
  dayjs.extend(timezone)
  dayjs.extend(customParseFormat)

  return dayjs.tz(date, 'Europe/London').format(format)
}

export function isNavLink(navLink: NavLink | NavLinkMenu): navLink is NavLink {
  return (navLink as NavLink).url !== undefined
}
