%{
/* Expression parsing for plural form selection.
   Copyright (C) 2000-2019 Free Software Foundation, Inc.
   Written by Ulrich Drepper <drepper@cygnus.com>, 2000.

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU Lesser General Public License as published by
   the Free Software Foundation; either version 2.1 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU Lesser General Public License for more details.

   You should have received a copy of the GNU Lesser General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.  */

/* For bison < 2.0, the bison generated parser uses alloca.  AIX 3 forces us
   to put this declaration at the beginning of the file.  The declaration in
   bison's skeleton file comes too late.  This must come before <config.h>
   because <config.h> may include arbitrary system headers.
   This can go away once the AM_INTL_SUBDIR macro requires bison >= 2.0.  */
#if defined _AIX && !defined __GNUC__
 #pragma alloca
#endif

#ifdef HAVE_CONFIG_H
# include <config.h>
#endif

#include <stddef.h>
#include <stdlib.h>
#include <string.h>
#include "plural-exp.h"

/* The main function generated by the parser is called __gettextparse,
   but we want it to be called PLURAL_PARSE.  */
#ifndef _LIBC
# define __gettextparse PLURAL_PARSE
#endif

%}
%parse-param {struct parse_args *arg}
%lex-param {struct parse_args *arg}
%define api.pure full
%expect 7

%union {
  unsigned long int num;
  enum expression_operator op;
  struct expression *exp;
}

%{
/* Prototypes for local functions.  */
static int yylex (YYSTYPE *lval, struct parse_args *arg);
static void yyerror (struct parse_args *arg, const char *str);

/* Allocation of expressions.  */

static struct expression *
new_exp (int nargs, enum expression_operator op,
	 struct expression * const *args)
{
  int i;
  struct expression *newp;

  /* If any of the argument could not be malloc'ed, just return NULL.  */
  for (i = nargs - 1; i >= 0; i--)
    if (args[i] == NULL)
      goto fail;

  /* Allocate a new expression.  */
  newp = (struct expression *) malloc (sizeof (*newp));
  if (newp != NULL)
    {
      newp->nargs = nargs;
      newp->operation = op;
      for (i = nargs - 1; i >= 0; i--)
	newp->val.args[i] = args[i];
      return newp;
    }

 fail:
  for (i = nargs - 1; i >= 0; i--)
    FREE_EXPRESSION (args[i]);

  return NULL;
}

static inline struct expression *
new_exp_0 (enum expression_operator op)
{
  return new_exp (0, op, NULL);
}

static inline struct expression *
new_exp_1 (enum expression_operator op, struct expression *right)
{
  struct expression *args[1];

  args[0] = right;
  return new_exp (1, op, args);
}

static struct expression *
new_exp_2 (enum expression_operator op, struct expression *left,
	   struct expression *right)
{
  struct expression *args[2];

  args[0] = left;
  args[1] = right;
  return new_exp (2, op, args);
}

static inline struct expression *
new_exp_3 (enum expression_operator op, struct expression *bexp,
	   struct expression *tbranch, struct expression *fbranch)
{
  struct expression *args[3];

  args[0] = bexp;
  args[1] = tbranch;
  args[2] = fbranch;
  return new_exp (3, op, args);
}

%}

/* This declares that all operators have the same associativity and the
   precedence order as in C.  See [Harbison, Steele: C, A Reference Manual].
   There is no unary minus and no bitwise operators.
   Operators with the same syntactic behaviour have been merged into a single
   token, to save space in the array generated by bison.  */
%right '?'		/*   ?		*/
%left '|'		/*   ||		*/
%left '&'		/*   &&		*/
%left EQUOP2		/*   == !=	*/
%left CMPOP2		/*   < > <= >=	*/
%left ADDOP2		/*   + -	*/
%left MULOP2		/*   * / %	*/
%right '!'		/*   !		*/

%token <op> EQUOP2 CMPOP2 ADDOP2 MULOP2
%token <num> NUMBER
%type <exp> exp

%%

start:	  exp
	  {
	    if ($1 == NULL)
	      YYABORT;
	    arg->res = $1;
	  }
	;

exp:	  exp '?' exp ':' exp
	  {
	    $$ = new_exp_3 (qmop, $1, $3, $5);
	  }
	| exp '|' exp
	  {
	    $$ = new_exp_2 (lor, $1, $3);
	  }
	| exp '&' exp
	  {
	    $$ = new_exp_2 (land, $1, $3);
	  }
	| exp EQUOP2 exp
	  {
	    $$ = new_exp_2 ($2, $1, $3);
	  }
	| exp CMPOP2 exp
	  {
	    $$ = new_exp_2 ($2, $1, $3);
	  }
	| exp ADDOP2 exp
	  {
	    $$ = new_exp_2 ($2, $1, $3);
	  }
	| exp MULOP2 exp
	  {
	    $$ = new_exp_2 ($2, $1, $3);
	  }
	| '!' exp
	  {
	    $$ = new_exp_1 (lnot, $2);
	  }
	| 'n'
	  {
	    $$ = new_exp_0 (var);
	  }
	| NUMBER
	  {
	    if (($$ = new_exp_0 (num)) != NULL)
	      $$->val.num = $1;
	  }
	| '(' exp ')'
	  {
	    $$ = $2;
	  }
	;

%%

void
FREE_EXPRESSION (struct expression *exp)
{
  if (exp == NULL)
    return;

  /* Handle the recursive case.  */
  switch (exp->nargs)
    {
    case 3:
      FREE_EXPRESSION (exp->val.args[2]);
      /* FALLTHROUGH */
    case 2:
      FREE_EXPRESSION (exp->val.args[1]);
      /* FALLTHROUGH */
    case 1:
      FREE_EXPRESSION (exp->val.args[0]);
      /* FALLTHROUGH */
    default:
      break;
    }

  free (exp);
}


static int
yylex (YYSTYPE *lval, struct parse_args *arg)
{
  const char *exp = arg->cp;
  int result;

  while (1)
    {
      if (exp[0] == '\0')
	{
	  arg->cp = exp;
	  return YYEOF;
	}

      if (exp[0] != ' ' && exp[0] != '\t')
	break;

      ++exp;
    }

  result = *exp++;
  switch (result)
    {
    case '0': case '1': case '2': case '3': case '4':
    case '5': case '6': case '7': case '8': case '9':
      {
	unsigned long int n = result - '0';
	while (exp[0] >= '0' && exp[0] <= '9')
	  {
	    n *= 10;
	    n += exp[0] - '0';
	    ++exp;
	  }
	lval->num = n;
	result = NUMBER;
      }
      break;

    case '=':
      if (exp[0] == '=')
	{
	  ++exp;
	  lval->op = equal;
	  result = EQUOP2;
	}
      else
	result = YYERRCODE;
      break;

    case '!':
      if (exp[0] == '=')
	{
	  ++exp;
	  lval->op = not_equal;
	  result = EQUOP2;
	}
      break;

    case '&':
    case '|':
      if (exp[0] == result)
	++exp;
      else
	result = YYERRCODE;
      break;

    case '<':
      if (exp[0] == '=')
	{
	  ++exp;
	  lval->op = less_or_equal;
	}
      else
	lval->op = less_than;
      result = CMPOP2;
      break;

    case '>':
      if (exp[0] == '=')
	{
	  ++exp;
	  lval->op = greater_or_equal;
	}
      else
	lval->op = greater_than;
      result = CMPOP2;
      break;

    case '*':
      lval->op = mult;
      result = MULOP2;
      break;

    case '/':
      lval->op = divide;
      result = MULOP2;
      break;

    case '%':
      lval->op = module;
      result = MULOP2;
      break;

    case '+':
      lval->op = plus;
      result = ADDOP2;
      break;

    case '-':
      lval->op = minus;
      result = ADDOP2;
      break;

    case 'n':
    case '?':
    case ':':
    case '(':
    case ')':
      /* Nothing, just return the character.  */
      break;

    case ';':
    case '\n':
    case '\0':
      /* Be safe and let the user call this function again.  */
      --exp;
      result = YYEOF;
      break;

    default:
      result = YYERRCODE;
#if YYDEBUG != 0
      --exp;
#endif
      break;
    }

  arg->cp = exp;

  return result;
}


static void
yyerror (struct parse_args *arg, const char *str)
{
  /* Do nothing.  We don't print error messages here.  */
}
