<?php

namespace App\Constants;

use App\Constants\ResponseConstants;

/**
 * Class to define constants related to Authentication.
 * This class provides a set of constants that are commonly used in authentication processes.
 */
Class AuthConstants extends ResponseConstants
{
  public const VALIDATION                           = "Invalid email or password.";
  public const REGISTER                             = "The user has been successfully registered.";
  public const LOGIN                                = "The user has successfully logged in.";
  public const LOGOUT                               = "The user has successfully logged out.";
  public const EMAIL_NOT_VERIFIED                   = "Email verification pending.";
  public const EMAIL_VERIFICATION_SUCCESS           = "Email verification successfull.";
  public const EMAIL_ALREADY_VERIFIED               = "Email already verified.";
  public const EMAIL_VERIFICATION_INVALID_ID        = "Invalid user id for email verification.";
  public const EMAIL_SIGNATURE_VERIFICATION_FAILURE = "Invalid or expired signature.";
  public const EMAIL_VERIFICATION_SENT              = "Email verification link sent successfully.";
  public const PASSWORD_RESET_LINK_SENT             = "Check your email for a password reset link.";
  public const PASSWORD_RESET_LINK_FAILED           = "Failed to send password reset link.";
  public const PASSWORD_RESET_LINK_TROTTLED         = "Password reset attempts exceeded.";
  public const PASSWORD_RESET_INVALID_TOKEN         = "Invalid or expired password reset token.";
  public const PASSWORD_RESET_SUCCESS               = "Your password has been successfully reset.";
  public const PASSWORD_RESET_FAILED                = "Failed to reset password.";
  public const PASSWORD_MISMATCH                    = "Mismatched password.";
  public const TOKEN_INVALID                        = "Invalid or expired token.";
  public const UNAUTHORIZED                         = "Unauthorized access.";
}
